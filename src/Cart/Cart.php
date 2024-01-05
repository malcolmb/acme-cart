<?php
namespace App\Cart;
use App\Catalog\CatalogInterface;
use App\Discount\DiscountInterface;
use App\Product\Product;
use App\Shipping\ShippingInterface;

class Cart implements CartInterface
{
    protected int $total;
    protected string $message = '';
    private array $items = [];
    private DiscountInterface $discount;
    private ShippingInterface $shipping;
    private CatalogInterface $catalog;

    public function __construct(
        CatalogInterface    $catalog,
        ShippingInterface  $shipping,
        DiscountInterface  $discount,
    ){
        $this->catalog  = $catalog;
        $this->shipping = $shipping;
        $this->discount = $discount;
    }
    public function addToCart(Product|string $code, int $qty)
    {
        if ($code instanceof Product) {
            $product = $code;
        } else {
            $product = Product::getProductById($code);
        }
        $id = $product->getId();
        $item = $this->findCartItem($id);
        if ($item === null){
            $this->items[$id] = $product;
        }
        $this->items[$id]->setQuantity($this->items[$id]->getQuantity() + $qty);
        return $item;
    }

    public function updateCart(){
    }
    public function getDiscounts()
    {
        return $this->discount->getDiscounts();

    }

    private function findCartItem(string $id)
    {
        return $this->items[$id] ?? null;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function clearCart(): void
    {
        $this->items = [];
    }

    public function getShipping()
    {
         return $this->shipping->calculate($this);
    }

    public function getQuantity(): int
    {
        return array_reduce($this->items, function ($result, $item){
            $result += $item->getQuantity();
            return $result;
        }, 0 );
    }

    public function getDiscountedTotal(): int
    {
        return array_reduce($this->items, function ($result, $item){
            $result += $this->calculateDiscounts($item);
            return $result;
        }, 0 );
    }

    public function getRawTotal(): int
    {
        return array_reduce($this->items, function ($result, $item){
            $result += ($item->getPrice() * $item->getQuantity());
            return $result;
        }, 0 );
    }
    public function getTotal(): int
    {
        $cartTotal = $this->getDiscountedTotal();
        $shippingCost = $this->getShipping();
        return $cartTotal + $shippingCost;
    }

    private function hasDiscount(Product $product): bool
    {
        $discounts = ($this->getDiscounts()) ? $this->getDiscounts() : null;

        foreach ($discounts as $discount){
            if ($discount['products'] === $product->getId() && $product->getQuantity() >= $discount['quantity']) {
                return true;
            }
        }
        return false;
    }

    private function calculateDiscounts(Product $product): float|int
    {
        $discounts = ($this->getDiscounts()) ? $this->getDiscounts() : null;
        $totalPrice = 0;

        if ($this->hasDiscount($product)) {
            foreach ($discounts as $discount){
                if ($product->getId() === $discount['products'] && $product->getQuantity() >= $discount['quantity']) {
                    $totalPrice += floor($product->getPrice() * ($discount['percent']  / 100));
                    $totalPrice += $product->getPrice() * ($product->getQuantity() -1);
                }
            }
        }  else {
            $totalPrice += ($product->getPrice() * $product->getQuantity());
        }
        return $totalPrice;

    }

}