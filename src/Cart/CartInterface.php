<?php
namespace App\Cart;
interface CartInterface
{
    public function updateCart();
    public function addToCart(string $code, int $qty);
    public function clearCart();
    public function getTotal();
    public function getQuantity();
    public function getShipping();
}