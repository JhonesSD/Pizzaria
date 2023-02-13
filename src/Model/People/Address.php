<?php

namespace Pizzeria\Model\People;

class Address
{
  private ?int $id;
  private string $street;
  private string $numberHouse;
  private string $district;
  private string $cep;

  public function __construct(?int $id,string $street, string $numberHouse, string $district, string $cep)
  {
    $this->id = $id;
    $this->street = $street;
    $this->numberHouse = $numberHouse;
    $this->district = $district;
    $this->cep = $cep;
  }

  public function getStreet()
  {
    return $this->street;
  }
  
  public function getId()
  {
    return $this->id;
  }

  public function setStreet($street): self
  {
    $this->street = $street;
    return $this;
  }

  public function getNumber_House()
  {
    return $this->numberHouse;
  }

  public function setNumber_House($number_House): self
  {
    $this->numberHouse = $number_House;
    return $this;
  }

  public function getDistrict()
  {
    return $this->district;
  }

  public function setDistrict($district): self
  {
    $this->district = $district;
    return $this;
  }

  public function getCep()
  {
    return $this->cep;
  }

  public function setCep($cep): self
  {
    $this->cep = $cep;
    return $this;
  }
}
