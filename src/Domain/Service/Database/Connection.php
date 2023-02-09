<?php

namespace Pizzeria\Domain\Service\Database;

use PDO;

Class Connection{

  public static function  myConnection():PDO{
    
    $connection = new PDO('mysql:host=localhost;dbname=Pizzeria', 'root', 'root');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $connection;
  }
}
