<?php

namespace Pizzeria\Domain\Contract;

use Pizzeria\Domain\Model\People\People;

interface ClientRepository{
  public function client(string $email):array;
  public function saveClient(People $people):bool;
}