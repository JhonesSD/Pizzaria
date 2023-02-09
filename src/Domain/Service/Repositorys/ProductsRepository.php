<?php

namespace Pizzeria\Domain\Service\Repositorys;

use Pizzeria\Domain\Model\Products\Products;
use Pizzeria\Domain\Contract\ProductsRepository as ContractProductsRepository;
use PDO;
use PDOStatement;

Class ProductsRepository implements ContractProductsRepository
{

  private PDO $connection;

  public function __construct(PDO $connection) {
    $this->connection = $connection;
  }

  public function products(string $type):array
  {
    $sqlQuery = "SELECT * FROM tb_products WHERE TYPE LIKE '$type%';";
    $stmt = $this->connection->prepare($sqlQuery);
    $stmt->execute();
    return $this->hydrateProducts($stmt);
    
  }

  public function saveProducts(Products $product): bool
  {
    if($product->getId() === null){
      return $this->insertProducts($product);
    }

    return $this->updateProducts($product);
  }

  public function updateProducts(Products $product): bool
  {
    $sqlQuery = 'UPDATE tb_products SET NAME = :NAME, SIZE = :SIZE, TYPE = :TYPE, PRICE = :PRICE WHERE ID = :ID;';
    $stmt = $this->connection->prepare($sqlQuery);

    $stmt->bindValue(':NAME', $product->getName(), PDO::PARAM_STR);
    $stmt->bindValue(':SIZE', $product->getSize(), PDO::PARAM_STR);
    $stmt->bindValue(':TYPE', $product->getType(), PDO::PARAM_STR);
    $stmt->bindValue(':PRICE', $product->getPrice(), PDO::PARAM_INT);
    $stmt->bindValue(':ID', $product->getId(), PDO::PARAM_INT);

    return $stmt->execute();
  }

  public function insertProducts(Products $product):bool
  {
    $sqlQuery = "INSERT INTO tb_products (NAME, SIZE, TYPE, PRICE) VALUES (:NAME, :SIZE, :TYPE, :PRICE);";
    $stmt = $this->connection->prepare($sqlQuery);
    
    $stmt->bindValue(':NAME', $product->getName(), PDO::PARAM_STR);
    $stmt->bindValue(':SIZE', $product->getSize(), PDO::PARAM_STR);
    $stmt->bindValue(':TYPE', $product->getType(), PDO::PARAM_STR);
    $stmt->bindValue(':PRICE', $product->getPrice(), PDO::PARAM_INT);
  
    return $stmt->execute();
  }

  public function removeProducts(Products $product):bool
  {
    $sqlQuery = "DELETE FROM tb_products WHERE ID = :ID;";
    $stmt = $this->connection->prepare($sqlQuery);
    $stmt->bindValue(':ID', $product->getId(), PDO::PARAM_INT);

    return $stmt->execute();
  }

  public function hydrateProducts(PDOStatement $stmt):array
  {
    $result = $stmt->fetchAll();
    $productList = [];

    foreach($result as $product){
      $productList[] = new Products(
        $product['ID'],
        $product['NAME'],
        $product['SIZE'],
        $product['TYPE'],
        $product['PRICE']
      );
    }
    return $productList;
  }
}