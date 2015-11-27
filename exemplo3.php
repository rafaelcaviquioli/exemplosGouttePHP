<?php
require_once("vendor/autoload.php");

$exemplo3 = new \Exemplo3();

//$_GET['busca'] = "Arvore";
//$_GET['limite'] = 1;

if(isset($_GET['busca']) AND isset($_GET['limite']) AND isset($_GET['categoria'])){

	$busca = $_GET['busca'];
	$limite = $_GET['limite'];
	$categoria = $_GET['categoria'];

	$resultados = $exemplo3->iniciar($busca, $limite, $categoria);
}

$categorias = array(
	'http://www.americanas.com.br/linha/350392/celulares-e-telefones/smartphone' => 'Smartphones',
	'http://www.americanas.com.br/linha/267868/informatica/notebook' => 'Notebooks',
	'http://www.americanas.com.br/linha/339090/informatica/impressora' => 'Impressoras',
	'http://www.americanas.com.br/linha/262909/tv-e-home-theater/tv' => 'TVs',
	'http://www.americanas.com.br/loja/256408/audio' => 'Áudio',
	'http://www.americanas.com.br/loja/228310/livros' => 'Livros'
);

include("views/exemplo3.php");
