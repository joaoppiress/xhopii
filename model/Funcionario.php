<?php

class Funcionario{
    private $cpf;
    private $nome;
    private $sobrenome;
    private $dataNasc;
    private $telefone;
    private $cargo;
    private $email;
    private $senha;
    private $salario;

    public function __construct($cpf, $nome, $sobrenome, $dataNasc, $telefone, $cargo, $email, $senha, $salario){
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->dataNasc = $dataNasc;
        $this->telefone = $telefone;
        $this->cargo = $cargo;
        $this->email = $email;
        $this->senha = $senha;
        $this->salario = $salario;
    }
}

?>
