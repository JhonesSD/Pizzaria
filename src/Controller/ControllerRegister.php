<?php

namespace Pizzeria\Controller;

session_start();

 echo var_dump($_POST);

$rua = $_POST["street"];

$_SESSION["street"] = $rua;
