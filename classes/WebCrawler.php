<?php
abstract class WebCrawler {
    protected $linksPendentes = array();
    protected $linksProcessados = array();

    protected static $URL;

	protected function procurarLinks($crawler) {
        $links = $crawler->filter("a")->each(function ($node, $i) {
            return trim($node->attr('href'));
        });
        $total = 0;
        foreach ($links as $link) {
            if ($this->validarLink($link)) {
                $this->adicionaLink($link);

                $total++;
            }
        }
        return $total;
    }

    protected function validarLink($link) {
        if (!in_array($link, $this->linksProcessados) AND !in_array($link, $this->linksPendentes) AND !is_null($link) AND ! empty($link) AND ( !preg_match_all("/http/", $link) OR preg_match_all("/" . str_replace("/", "\/", self::$URL) . "/", $link)) AND ! preg_match_all("/whatsapp/", $link) AND! preg_match_all("/mailto:/", $link) AND ! preg_match_all("/.js/", $link) AND ! preg_match_all("/javascript/", $link) AND ! preg_match_all("/#/", $link) AND ! preg_match_all('/"/', $link)) {
            
            return true;
        } else {
            return false;
        }
    }
    //Método para sobrescrita
    protected function validaPrioridade($link){
        return false;
    }
    protected function adicionaLink($link = null){
        if($link){

            //Tratamento de caracteres não suportados.
            $link = str_replace(array('\n', '\t', '\r', '^M'), null, $link);
            if($this->validaPrioridade($link)){
                array_unshift($this->linksPendentes, $link);
                $this->log->registrar("Adicionado link em prioridade alta $link");
            }else{
                $this->linksPendentes[] = $link;
            }
        }
    }
    protected function getTotalLinksPendentes(){
        return count($this->linksPendentes);
    }
    protected function getProximoLinkPendente() 
    {
        $link = array_shift($this->linksPendentes);

        return $link;
    }
    static function retirarAcentos($palavra)
    {
        $tabelaDeCaracteres = array('À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', '°' => '', '%' => '', 'º' => '', 'ª' => '', '´' => '', '*' => '', "'" => "", '"' => '', '?' => '-');
        return strtr($palavra, $tabelaDeCaracteres);
    }
}