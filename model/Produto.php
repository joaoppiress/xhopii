<?php

class Produto{

    private $nome;
    private $fabricante;
    private $descricao;
    private $valor;
    private $quantidade;
    private $imagem;

    public function __construct($Nome, $Fabricante, $Descricao, $Valor, $Quantidade, $Imagem){
        $this->nome = $Nome;
        $this->fabricante = $Fabricante;
        $this->descricao = $Descricao;
        $this->valor = $Valor;
        $this->quantidade = $Quantidade;
        $this->imagem = $Imagem;
    }

    public function get_Nome(){
        return($this->nome);
    }

    public function get_Fabricante(){
        return($this->fabricante);
    }

    public function get_Descricao(){
        return($this->descricao);
    }

    public function get_Valor(){
        return($this->valor);
    }

    public function get_Quantidade(){
        return($this->quantidade);
    }
    
    public function get_Imagem(){
        return($this->imagem);
    }

    public function set_Nome($Nome){
        $this->nome = $Nome;
    }

    public function set_Fabricante($Fabricante){
        $this->fabricante = $Fabricante;
    }

    public function set_Descricao($Descricao){
        $this->descricao = $Descricao;
    }

    public function set_Valor($Valor){
        $this->valor = $Valor;
    }

    public function set_Quantidade($Quantidade){
        $this->quantidade = $Quantidade;
    }

    public function set_Imagem($Imagem){
        $this->imagem = $Imagem;
    }
}