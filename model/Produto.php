<?php

class Produto{

    protected $nome;
    protected $fabricante;
    protected $descricao;
    protected $valor;
    protected $quantidade;

    public function __construct($Nome, $Fabricante, $Descricao, $Valor, $Quantidade){
        $this->nome = $Nome;
        $this->fabricante = $Fabricante;
        $this->descricao = $Descricao;
        $this->valor = $Valor;
        $this->quantidade = $Quantidade;
    }

    public function get_Nome(){ return $this->nome; }
    public function get_Fabricante(){ return $this->fabricante; }
    public function get_Descricao(){ return $this->descricao; }
    public function get_Valor(){ return $this->valor; }
    public function get_Quantidade(){ return $this->quantidade; }
}
?>