<?php

class Loja {

    private $nome;
    private $descricao;
    private $telefone;
    private $email;
    private $senha;
    private $cidade;
    private $imagem;

    public function __construct($nome, $descricao, $telefone, $email, $senha, $cidade, $imagem = "sem-foto.png") {
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->senha = $senha;
        $this->imagem = $imagem;
        $this->cidade = $cidade;
    }



    public function getNome(){
        return $this->nome;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function getTelefone(){
        return $this->telefone;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function getCidade(){
        return $this->cidade;
    }

    public function getImagem(){
        return $this->imagem;
    }



    public function setNome($nome){
        $this->nome = $nome;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function setCidade($cidade){
        $this->cidade = $cidade;
    }

    public function setImagem($imagem){
        $this->imagem = $imagem;
    }

}
?>