<?php

class Cupom{

    private $codigo;
    private $desconto;
    private $validade;

    public function __construct($codigo, $desconto, $validade){
        $this->codigo = $codigo;
        $this->desconto = $desconto;
        $this->validade = $validade;
    }

    public function getCodigo(){
        return $this->codigo;
    }

    public function getDesconto(){
        return $this->desconto;
    }

    public function getValidade(){
        return $this->validade;
    }

}

?>