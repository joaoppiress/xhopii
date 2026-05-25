<?php

class Cliente {

    private $cpf;
    private $nome;
    private $sobrenome;
    private $dataNasc;
    private $telefone;
    private $email;
    private $senha;

    public function __construct($cpf, $nome, $sobrenome, $dataNasc, $telefone, $email, $senha){
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->dataNasc = $dataNasc;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->senha = $senha;
    }

}

?>