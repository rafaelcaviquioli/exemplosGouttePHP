<?php
require_once("vendor/autoload.php");

$busca = $_GET['busca'];

$exemplo2 = new \Exemplo2();

$resultados = array();

if(!empty($busca)){
    $resultados[] = $exemplo2->buscar($busca);
}
//$resultados[] = $exemplo2->buscar("Blumenau");
//$resultados[] = $exemplo2->buscar("Brusque");
//$resultados[] = $exemplo2->buscar("balneário Camboriú");
//$resultados[] = $exemplo2->buscar("Camboriú");

include("views/exemplo2.php");