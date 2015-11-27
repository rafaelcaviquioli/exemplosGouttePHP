<?php
use Goutte\Client;
/*
* Classe para exemplo do Wikipédia
*/

class Exemplo3 extends WebCrawler{

	protected static $URL = "https://www.americanas.com.br";
	const LOG_FILE = "log/exemplo3.log";

	//Cliente Crawler (Navegador)
	private $client;

	private $form;

	private $search;

	private $limite;

    public function iniciar($search, $limite) {
		$this->search = $search;
		$this->limite = $limite;

		$this->log = new \Log(self::LOG_FILE);
        $this->log->registrar("Iniciando:" . self::$URL);

        while ($this->getTotalLinksPendentes()) {

            try {

            	$link = $this->getProximoLinkPendente();

                $this->log->registrar("Abrindo: $link");

                $crawler = $this->client->request('GET', $link);
                if(!$crawler){
                    //Pula para a próxima
                    $this->log->registrar("Link não aberto: $Link");
                    continue;
                }
                if ($totalLinks = $this->procurarLinks($crawler)) {
                    $this->log->registrar("Links encontrados: $totalLinks");
                }
                try {
                	//Executa tarefa
                } catch (Exception $e) {
                    $this->log->registrar($e->getMessage());
                }

                $this->log->registrar("Status da fila: " . $this->getTotalLinksPendentes());
            } catch (Exception $e) {
                $this->log->registrar("Erro : " . $e->getMessage());
            }
        }
    }
}