<?php
namespace App\Discount;

class Discount implements DiscountInterface
{
    public function __constructor(){

    }
    public function getDiscounts(): array
    {
//        get all available discounts from db.
        return array(
            1 => [
                "name" => "buy one red widget, get the second half price",
                "percent" => 50,
                "type" => 1,
                "quantity" => 2,
                "products" => "R01",
                "allow_multiples" => false,
            ]
        );
    }
}