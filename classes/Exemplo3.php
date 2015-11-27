<?php
use Goutte\Client;
/*
* Classe para exemplo do Wikipédia
*/

class Exemplo3 extends WebCrawler{

	const LOG_FILE = "log/exemplo3.log";

	//Cliente Crawler (Navegador)
	private $client;

	private $form;

    public function iniciar() {
    	$contador = 0;


		$this->log = new \Log(self::LOG_FILE);
        $this->log->registrar("Iniciando...");

		$this->client = new Client();

		self::$URL = "http://www.americanas.com.br";

        $this->adicionaLink(self::$URL);

        $resultados = array();
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
                	$titulo = trim($crawler->filter('.mp-tit-name')->text());
                	$valorDe = trim($crawler->filter('.mp-pb-from')->text());
                	$valorAte = trim($crawler->filter('.mp-pb-to')->text());
                	$imagens = trim($crawler->filter('[itemprop=thumbnail]')->each(function($node){
                		return $node->attr("src");
                	}));
					var_dump($imagens);
                	if(isset($titulo) AND isset($valorDe) AND isset($valorAte)){
                		$resultados[] = array("titulo" => $titulo, "de" => $valorDe, "por" => $valorAte, "link" => $link, "imagens" => $imagens);
                	}

                	$this->linksProcessados[] = $link;
                } catch (Exception $e) {
                    $this->log->registrar($e->getMessage());
                }

                $this->log->registrar("Status da fila: " . $this->getTotalLinksPendentes());
            } catch (Exception $e) {
                $this->log->registrar("Erro : " . $e->getMessage());
            }

            $contador++;

            if($contador == 2){
            	return $resultados;
            }
        }
    }
    protected function validaPrioridade($link){
    	//Valida se há a palavra produto na url
        if (preg_match_all("/produto/", $link) OR preg_match_all("/redfriday/", $link)) {
            return true;
        } else {
            return false;
        }
    }
}