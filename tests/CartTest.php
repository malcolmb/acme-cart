<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function testCart(): void
    {
        $productIds = array("B01", "R01", "G01");
        $catalog = new \App\Catalog\Catalog($productIds);
        $shipping = new \App\Shipping\Shipping();
        $discount = new \App\Discount\Discount();
        $cart = new \App\Cart\Cart($catalog, $shipping, $discount);
        $widget = new \App\Product\Product("W01", "White Widget", 1795);

        $cart->addToCart("B01", 1);//Add first product
        $cart->addToCart("G01", 1);//Add second product
        echo "Quantity:{$cart->getQuantity()}, Subtotal: {$cart->getRawTotal()}" .PHP_EOL;
        echo "Total w/ Discounts:{$cart->getDiscountedTotal()}, Shipping:{$cart->getShipping()}" .PHP_EOL;
        echo "Final Total:{$cart->getTotal()}" .PHP_EOL;
        $this->assertEquals(2, $cart->getQuantity());
        $this->assertEquals(3290, $cart->getRawTotal());
        $this->assertEquals(495, $cart->getShipping());
        $this->assertEquals(3785, $cart->getTotal());


        $cart->clearCart(); //Clear cart for next test

        $cart->addToCart("R01", 2);//Add 2 red widgets to test BOGO
        echo "Quantity:{$cart->getQuantity()}, Subtotal: {$cart->getRawTotal()}" .PHP_EOL;
        echo "Total w/ Discounts:{$cart->getDiscountedTotal()}, Shipping:{$cart->getShipping()}" .PHP_EOL;
        echo "Final Total:{$cart->getTotal()}" .PHP_EOL;
        $this->assertEquals(2, $cart->getQuantity());
        $this->assertEquals(6590, $cart->getRawTotal());
        $this->assertEquals(495, $cart->getShipping());
        $this->assertEquals(5437, $cart->getTotal());


        $cart->clearCart(); //Clear cart for next test

        $cart->addToCart("R01", 1);//Add first product
        $cart->addToCart("G01", 1);//Add additional product and retest
        echo "Quantity:{$cart->getQuantity()}, Subtotal: {$cart->getRawTotal()}" .PHP_EOL;
        echo "Total w/ Discounts:{$cart->getDiscountedTotal()}, Shipping:{$cart->getShipping()}" .PHP_EOL;
        echo "Final Total:{$cart->getTotal()}" .PHP_EOL;
        $this->assertEquals(2, $cart->getQuantity());
        $this->assertEquals(5790, $cart->getRawTotal());
        $this->assertEquals(295, $cart->getShipping());
        $this->assertEquals(6085, $cart->getTotal());

        $cart->clearCart(); //Clear cart for next test

        $cart->addToCart("B01", 1);//Add first product
        $cart->addToCart("B01", 1);//Add it again to verify quantity increases
        $cart->addToCart("R01", 1);//Add second product
        $cart->addToCart("R01", 1);//Add second product again to verify quantity increases
        $cart->addToCart("R01", 1);//Add second product again to verify quantity increases
        echo "Quantity:{$cart->getQuantity()}, Subtotal: {$cart->getRawTotal()}" .PHP_EOL;
        echo "Total w/ Discounts:{$cart->getDiscountedTotal()}, Shipping:{$cart->getShipping()}" .PHP_EOL;
        echo "Final Total:{$cart->getTotal()}" .PHP_EOL;
        $this->assertEquals(5, $cart->getQuantity());
        $this->assertEquals(11475, $cart->getRawTotal());
        $this->assertEquals(0, $cart->getShipping());
        $this->assertEquals(9827, $cart->getTotal());


        //Additional test for passing an instance of Product to cart.
        $cart->clearCart();

        $cart->addToCart($widget, 1);
        echo "Quantity:{$cart->getQuantity()}, Subtotal: {$cart->getRawTotal()}" .PHP_EOL;
        echo "Total w/ Discounts:{$cart->getDiscountedTotal()}, Shipping:{$cart->getShipping()}" .PHP_EOL;
        echo "Final Total:{$cart->getTotal()}" .PHP_EOL;
        $this->assertEquals(1, $cart->getQuantity());
        $this->assertEquals(1795, $cart->getRawTotal());
        $this->assertEquals(495, $cart->getShipping());
        $this->assertEquals(2290, $cart->getTotal());

    }
}