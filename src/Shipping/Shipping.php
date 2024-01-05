<?php
namespace App\Shipping;
class Shipping implements ShippingInterface
{
    const int DEFAULT_SHIPPING = 995;
    public function __construct(){

    }
    public static function getShippingRates(): array
    {
        return [
            1 => [
                "method" => "price",
                "carrier" => "default",
                "active" => 1,
                "min" => 0,
                "max" => 5000,
                "cost" => 495
            ],
            2 => [
                "method" => "price",
                "carrier" => "default",
                "active" => 1,
                "min" => 5010,
                "max" => 9000,
                "cost" => 295
            ],
            3 => [
                "method" => "price",
                "carrier" => "default",
                "active" => 1,
                "min" => 9001,
                "max" => 99999999,
                "cost" => 00
            ],
            4 => [
                "method" => "weight",
                "carrier" => "default",
                "active" => 1,
                "min" => 0,
                "max" => 9900,
                "cost" => 00
            ],
        ];
    }

    public static function getShippingRatesByPrice(): array
    {
        $allRates = self::getShippingRates();
        return array_filter($allRates, function($v){return $v['method'] === 'price';});
    }

    public function calculate($cart): int
    {
        $rates = self::getShippingRatesByPrice();
        $cartTotal = $cart->getDiscountedTotal();
        return self::inRange($cartTotal, $rates);
    }

    public static function inRange(int $cartTotal, array $rates): int
    {
        $cost = self::DEFAULT_SHIPPING;
        $shipping = array_values(array_filter($rates, function($k) use ($cartTotal) { return ($cartTotal >= $k['min'] ) && ( $cartTotal < $k['max']); }));
        return ($shipping[0]) ? $shipping[0]['cost'] : $cost;
    }
}