<?php

namespace Pizzeria\Model\People;

require '/vendor/autoload.php';

use Pizzeria\Model\People\Cpf as PeopleCpf;

class  People
{
  private ?int $id;
  private string $name;
  private int $age;
  private string $email;
  private string $password;
  private Cpf $cpf;
  private Address $address;

  public function __construct(
    ?int $id,
    string $name,
    string $birthDate,
    string $email,
    string $password,
    Cpf $cpf,
    Address $address
  ) {
    $this->id = $id;
    $this->name = $name;
    $this->age = $this->calculateAge($birthDate);
    $this->email = $email;
    $this->password = $password;
    $this->address = $address;
    $this->cpf = $cpf;
  }

  public function getId():int
  {
    return $this->id;
  }

  public function getName():string
  {
    return $this->name;
  }

  public function getAge():int
  {
    return $this->age;
  }

  public function getAddress():Address
  {
    return $this->address;
  }

  public function getCpf():PeopleCpf
  {
    return $this->cpf;
  }

  public function getEmail():string
  {
    return $this->email;
  }


  public function getPassword()
  {
    return $this->password;
  }


  public function setPassword($password): self
  {
    if($this->password == null){
    $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    return $this;
  }

  private function calculateAge(string $birthDate): int
  {
    $date = date('Y-m-d', strtotime($birthDate));
    list($year, $mouth, $day) = explode('-', $date);

    $currentDate = date('Y');
    $age = $currentDate - $year;

    if (date('m') <= $mouth) {
      $age--;

      if (date('m') == $mouth && date('d') <= $day) {
        $age--;
      }
    }
    return $age;
  }
}
