<?php
use Goutte\Client;

/*
* Classe para exemplo do Wikipédia
*/

class Exemplo2 {

	const URL = "https://pt.wikipedia.org/";

	//Cliente Crawler (Navegador)
	private $client;

	private $form;

	function __construct() {
		$this->client = new Client();

		//Acessar a pagina inicial da Wikipédia
		$crawler = $this->client->request('GET', self::URL);

		//Seleciona o botão GO (Buscar) e traz o formulário do botão
		$this->form = $crawler->selectButton('go')->form();
		
	}

	public function buscar($search){
		//Parametro que representa o input do html
		$parametros = array('search' => $search);

		//Submete o formulário passando os parametros
		$crawler = $this->client->submit($this->form, $parametros);

		$resultado = new stdClass();

		//Título da página
		$resultado->titulo = $crawler->filter('h1')->text();

		$resultado->imagens = $crawler->filter(".thumbinner .image img")->each(function ($node) {
		    return $node->attr('src');
		});

		$resultado->descricao = $crawler->filter(".mw-content-ltr > p")->each(function ($node) {
		    return $node->text();
		});

			
		return $resultado;
	}
}