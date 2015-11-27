<?php
require_once("vendor/autoload.php");

$busca = $_GET['busca'];

$exemplo2 = new \Exemplo2();

$resultado = null;

if(!empty($busca)){
    $resultado = $exemplo2->buscar($busca);
}

include("views/exemplo2.php");