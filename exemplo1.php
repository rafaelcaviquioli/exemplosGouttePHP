<?php
require_once("vendor/autoload.php");

use Goutte\Client;

$client = new Client();

$url = 'http://www.itajai.sc.gov.br';

//Acessar site da prefeitura de Itajaí
$crawler = $client->request('GET', $url);

//Selecionar link Notícias
$link = $crawler->selectLink('Notícias')->link();

//Clicar no link Notícias
$crawler = $client->click($link);

//Definir seletor utilizado para chegar até o conteudo
$seletor = '#conteudo > .dpag_noticia > .dpag_noticia_dados > a';

//Filtrar dados
$noticias = $crawler->filter($seletor)->each(function ($node) {
	//Obtem data da nocícia que está dentro da tag <a>
    $data = $node->filter(".dpag_noticia_data")->text();

    //Obtem titulo da nocícia que está dentro da tag <a>
    $titulo = $node->filter(".dpag_noticia_titulo")->text();

    //Obtem subtítulo da nocícia que está dentro da tag <a>
    $subtitulo = $node->filter(".dpag_noticia_descricao")->text();

    //Obtem link da notícia
    $link = $node->attr("href");

    //Retorna array com a data e titulo
    return array(
    	'data' => $data,
    	'titulo' => $titulo,
    	'subtitulo' => $subtitulo,
    	'link' => $link
    );
});

include("views/exemplo1.php");