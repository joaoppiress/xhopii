<?php

class Controlador {

    private $bancoDeDados;

    function __construct() {
        $this->bancoDeDados = new BancoDeDados("localhost", "root", "", "xhopii");
    }

    public function cadastrarCliente($cpf, $nome, $sobrenome, $dataNasc, $telefone, $email, $senha) {
        $this->bancoDeDados->inserirCliente($cpf, $nome, $sobrenome, $dataNasc, $telefone, $email, $senha);
    }

    public function loginCliente($email, $senha) {
        $cliente = $this->bancoDeDados->buscarClientePorEmail($email);
        if ($cliente && password_verify($senha, $cliente['senha'])) {
            return $cliente;
        }
        return false;
    }

    public function cadastrarFuncionario($cpf, $nome, $sobrenome, $dataNasc, $telefone, $cargo, $email, $senha, $salario) {
        $this->bancoDeDados->inserirFuncionario($cpf, $nome, $sobrenome, $dataNasc, $telefone, $cargo, $email, $senha, $salario);
    }
    public function loginFuncionario($email, $senha) {
        $funcionario = $this->bancoDeDados->buscarFuncionarioPorEmail($email);
        if ($funcionario && password_verify($senha, $funcionario['senha'])) {
            return $funcionario;
        }
        return false;
    }
    public function cadastrarProduto($nome, $fabricante, $descricao, $valor, $quantidade) {
        $produto = new Produto($nome, $fabricante, $descricao, $valor, $quantidade);
        $this->bancoDeDados->inserirProduto($produto);
    }

}

?>