<?php
namespace App\Shipping;
use App\Cart\Cart;

interface ShippingInterface {

    public function calculate(Cart $cart);
}