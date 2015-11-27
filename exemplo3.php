<?php
require_once("vendor/autoload.php");

$busca = $_GET['busca'];
$limite = $_GET['limite'];

$exemplo3 = new \Exemplo3();

$exemplo3->iniciar($busca, $limite);

include("views/exemplo3.php");