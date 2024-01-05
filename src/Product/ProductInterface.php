<?php

namespace App\Product;

interface ProductInterface
{
 public function getId();
 public function getName();
 public function getPrice();
 public function setQuantity(int $qty);
 public function getQuantity();
}