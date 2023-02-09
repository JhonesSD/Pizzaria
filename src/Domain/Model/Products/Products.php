<?php

namespace Pizzeria\Domain\Model\Products;

Class Products
{

  private ?int $id;
  private string $name;
  private string $size;
  private string $type;
  private float $price;

  public function __construct
  (?int $id, 
  string $name, 
  string $size, 
  string $type, 
  float $price) 
  {
    $this->id = $id;
    $this->name = $name;
    $this->size = $size;
    $this->type = $type;
    $this->price = $price;
  }

    public function setName($name):void
    {
        $this->name = $name;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function getSize():string
    {
        return $this->size;
    }

    public function setSize($size):void
    {
        $this->size = $size;
    }

    public function getType():string
    {
        return $this->type;
    }

    public function setType($type):void
    {
        $this->type = $type;
    }
 
    public function getPrice():float
    {
        return $this->price;
    }

    public function setPrice($price):void
    {
        $this->price = $price;
    }
 
    public function getId():?int
    {
        return $this->id;
    }
}