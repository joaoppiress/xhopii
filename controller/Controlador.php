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

    public function cadastrarProduto($nome, $fabricante, $descricao, $valor) {
        $produto = new Produto($nome, $fabricante, $descricao, $valor);
        $this->bancoDeDados->inserirProduto($produto);
    }

}

?>