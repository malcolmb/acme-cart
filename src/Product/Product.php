<?php
namespace App\Product;
class Product implements ProductInterface
{
    private string $id;
    private string $name;
    private int $price;
    private int $quantity = 0;

    public function __construct(string $id, string $name, int $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }
    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getPrice(): int
    {
        return $this->price;
    }
    public function setQuantity(int $qty): int
    {
        return $this->quantity = $qty;
    }
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public static function getProductById(string $id): ?Product
    {
        if ($id) {
            $product = self::getProduct($id);
            return new Product($product['id'], $product['name'], $product['price']);
        } else {
            return null;
        }
    }

    private static function getProduct(string $id): false|array
    {
        $products =  array(
            "R01" => [
                "id" => "R01",
                "name" => "Red Widget",
                "price" => 3295,
                "quantity_discount" => 1,
                "requires_shipping" => true,
            ],
            "G01" => [
                "id" => "G01",
                "name" => "Green Widget",
                "price" => 2495,
                "quantity_discount" => 0,
                "requires_shipping" => true,
            ],
            "B01" => [
                "id" => "B01",
                "name" => "Blue Widget",
                "price" => 795,
                "quantity_discount" => 0,
                "requires_shipping" => true,
            ]
        );
        return $products[$id] ?? false;
    }

}