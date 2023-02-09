<?php

namespace Pizzeria\Domain\Service\Repositorys;

use Pizzeria\Domain\Contract\ClientRepository as ContractClientRepository;
use Pizzeria\Domain\Model\People\People;
use Pizzeria\Domain\Model\People\Cpf;
use Pizzeria\Domain\Model\People\Address;
use PDOStatement;
use PDO;

Class ClientRepository implements ContractClientRepository{

  private PDO $connection;
  
  public function __construct(PDO $connection) {
      $this->connection = $connection;
    }

  public function client(string $email):array
  {
    $sqlQuery = "SELECT * FROM tb_client client INNER JOIN tb_address address ON client.ID = address.ID_CLIENT WHERE EMAIL LIKE '%$email%';";
    $stmt = $this->connection->prepare($sqlQuery);
    $stmt->execute();
    
    return $this->hydrateClient($stmt);
  }

  public function saveClient(People $people): bool
  {
    if($people->getId() === null){
      return $this->insertClient($people);
    }

    return $this->updateClient($people);
  }

  public function insertClient(People $people):bool
  {
    $sqlQuery = 'INSERT INTO tb_client (CPF, NAME, BIRTHDATE, EMAIL, PASSWORD) VALUES (:CPF, :NAME, :BIRTHDATE, :EMAIL, :PASSWORD);';
    $stmt = $this->connection->prepare($sqlQuery);
    $stmt->bindValue(':CPF', $people->getCpf(), PDO::PARAM_STR);
    $stmt->bindValue(':NAME', $people->getName(), PDO::PARAM_STR);
    $stmt->bindValue(':BIRTHDATE', $people->getAge(), PDO::PARAM_STR);
    $stmt->bindValue(':EMAIL', $people->getEmail(), PDO::PARAM_STR);
    $stmt->bindValue(':PASSWORD', $people->getPassword(), PDO::PARAM_STR);

    return $stmt->execute();

  }

  public function updateClient(People $people):bool
  {
    $sqlQuery = "UPDATE tb_client SET CPF = :CPF, NAME = :NAME, BIRTHDATE = :BIRTHDATE, EMAIL = :EMAIL, PASSWORD = :PASSWORD WHERE ID = :ID;";
    $stmt = $this->connection->prepare($sqlQuery);

    $stmt->bindValue(':CPF', $people->getCpf(), PDO::PARAM_STR);
    $stmt->bindValue(':NAME', $people->getName(), PDO::PARAM_STR);
    $stmt->bindValue(':BIRTHDATE', $people->getAge(), PDO::PARAM_STR);
    $stmt->bindValue(':EMAIL', $people->getEmail(), PDO::PARAM_STR);
    $stmt->bindValue(':PASSWORD', $people->getPassword(), PDO::PARAM_STR);

    return $stmt->execute();
  }

  public function hydrateClient(PDOStatement $stmt):array
  {
    $result = $stmt->fetchAll();
    $clientData = [];
    
    foreach($result as $client){
    $clientData[] = new People(
      $client['ID'],
      $client['NAME'],
      $client['BIRTHDATE'],
      $client['EMAIL'],
      $client['PASSWORD'],
      new CPF($client['CPF']),
      new Address(
      $client['ID'],
      $client['STREET'],
      $client['NUMBER_HOUSE'],
      $client['DISTRICT'],
      $client['CEP']
      )
    );
  }
    return $clientData;
  }
}