<?php
namespace App\Catalog;

interface CatalogInterface
{
    public function setProductIds(array $productIds);
    public function getProductIds(): array;
    public function getCatalog(): array;
}