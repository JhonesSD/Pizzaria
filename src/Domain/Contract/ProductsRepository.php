<?php

namespace Pizzeria\Domain\Contract;

use Pizzeria\Domain\Model\Products\Products;

interface ProductsRepository{
  public function products(string $type):array;
  public function saveProducts(Products $product):bool;
  public function updateProducts(Products $product):bool;
  public function removeProducts(Products $product):bool;
}