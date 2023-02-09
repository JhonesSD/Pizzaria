<?php

require './vendor/autoload.php';

use Pizzeria\Domain\Service\Database\Connection;
use Pizzeria\Domain\Service\Repositorys\ClientRepository;
use Pizzeria\Domain\Service\Repositorys\ProductsRepository;



$connection = Connection::myConnection();
$tst = new ProductsRepository($connection);
var_dump($tst->products('pizza'));

  