<?php

namespace App\Catalog;

use App\Product\Product;

class Catalog implements CatalogInterface
{
    private array $productIds;
    public function __construct(array $productIds){
        $this->setProductIds($productIds);
    }

    public  function getProductIds(): array
    {
        return $this->productIds;
    }
    public  function setProductIds(array $productIds):void
    {
        $this->productIds = $productIds;
    }
    public function getCatalog(): array
    {
        $products = array();
        $productIds = $this->getProductIds();

        foreach ($productIds as $productId){
            if (Product::getProductById($productId)) {
                $products[] = Product::getProductById($productId);
            }
        }
        return $products;
    }
}