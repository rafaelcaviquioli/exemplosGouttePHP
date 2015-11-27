<?php
abstract class WebCrawler {
    protected $linksPendentes = array();

    protected static $URL;

	protected function procurarLinks($crawler) {
        $links = $crawler->filter('a')->each(function ($node, $i) {
            return trim($node->attr('href'));
        });
        foreach ($links as $link) {
            if ($this->validarLink($link)) {
                $this->adicionaLink($link);
            }
        }
        return count($links);
    }

    protected function validarLink($link) {
        if (!in_array($link, $this->linksPendentes) AND !is_null($link) AND ! empty($link) AND ( !preg_match_all("/http/", $link) OR preg_match_all("/" . str_replace("/", "\/", self::$URL) . "/", $link)) AND ! preg_match_all("/whatsapp/", $link) AND! preg_match_all("/mailto:/", $link) AND ! preg_match_all("/.js/", $link) AND ! preg_match_all("/javascript/", $link) AND ! preg_match_all("/#/", $link) AND ! preg_match_all('/"/', $link)) {
            return true;
        } else {
            return false;
        }
    }
    protected function adicionaLink($link = null){
        if($link){

            //Tratamento de caracteres não suportados.
            $link = str_replace(array('\n', '\t', '\r', '^M'), null, $link);

            $this->linksPendentes[] = $link;
        }
    }
    protected function getTotalLinksPendentes(){
        return count($this->linksPendentes);
    }
    protected function getProximoLinkPendente()
    {
        return array_shift($this->linksPendentes);
    }
}