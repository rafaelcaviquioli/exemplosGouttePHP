<?php

class Log {

    function __construct($arquivo = NULL) {
        $this->_ponteiro = NULL;
        $this->_arquivo = NULL;
        $this->_operador = NULL;
        if (!is_null($arquivo)) {
            $this->abrir($arquivo);
        }
    }

    public function abrir($arquivo) {
        $this->_arquivo = $arquivo;
        $this->_ponteiro = fopen($this->_arquivo, "a+");
        if (!$this->_ponteiro) {
            print "Erro ao abrir arquivo de log: " . $this->_arquivo;
        }
    }

    public function registrar($tipo = NULL, $descricao = NULL) {
        if ($this->_ponteiro) {
            $log = "[" . date("d/m/Y H:i:s") . " " . $this->_operador . "]" . " - " . $tipo;
            if ($descricao != NULL) {
                $log .= " - " . $descricao;
            }
            $log .= "\n";
            if (!fwrite($this->_ponteiro, $log)) {
                print "Erro ao registrar log.";
            }
        } else {
            print "Erro - Arquivo nao aberto para registro.";
        }
    }

    public function fechar() {
        fclose($this->_ponteiro);
    }

}