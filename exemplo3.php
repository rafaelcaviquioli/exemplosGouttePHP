<?php
require_once("vendor/autoload.php");

$exemplo3 = new \Exemplo3();
$resultados = $exemplo3->iniciar();

include("views/exemplo3.php");