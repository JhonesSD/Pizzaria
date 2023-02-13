<?php

namespace Pizzeria\Model\Order;

use DateTime;

Class Order{

  private ?int $id; 
  private int $nf;
  private int $requestNumber;
  private DateTime $date;
  private $productList = [];

    public function getId()
  {
    return $this->id;
  }
 
  public function getNf()
  {
    return $this->nf;
  }

  public function getRequestNumber()
  {
    return $this->requestNumber;
  }


  public function getDate()
  {
    return $this->date;
  }

  public function getProductList()
  {
    return $this->productList;
  }
}