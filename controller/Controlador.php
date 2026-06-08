<?php
require_once __DIR__ . "/../model/BancoDeDados.php";
require_once __DIR__ . "/../model/Produto.php";
require_once __DIR__ . "/../model/Cupom.php";
require_once __DIR__ . "/../model/Funcionario.php";
require_once __DIR__ . "/../model/Loja.php";

class Controlador {

    private $bancoDeDados;

    function __construct() {
        $this->bancoDeDados = new BancoDeDados("localhost", "root", "", "xhopii");
    }

    public function cadastrarCliente(
    $cpf,
    $nome,
    $sobrenome,
    $dataNasc,
    $telefone,
    $email,
    $senha,
    $foto
    ) 
    {

    $this->bancoDeDados->inserirCliente(
        $cpf,
        $nome,
        $sobrenome,
        $dataNasc,
        $telefone,
        $email,
        $senha,
        $foto
    );
    }   

    public function loginCliente($email, $senha) {
        $cliente = $this->bancoDeDados->buscarClientePorEmail($email);

        if ($cliente && password_verify($senha, $cliente['senha'])) {
            return $cliente;
        }

        return false;
    }

    public function cadastrarFuncionario($cpf, $nome, $sobrenome, $dataNasc, $telefone, $cargo, $email, $senha, $salario, $imagem) {
        $this->bancoDeDados->inserirFuncionario($cpf, $nome, $sobrenome, $dataNasc, $telefone, $cargo, $email, $senha, $salario, $imagem);
    }


    public function cadastrarProduto($nome, $fabricante, $descricao, $valor, $quantidade, $imagem) {

        $produto = new Produto(
            $nome,
            $fabricante,
            $descricao,
            $valor,
            $quantidade,
            $imagem
        );

        $this->bancoDeDados->inserirProduto($produto);
    }   

    public function buscarProdutos($busca) {
    return $this->bancoDeDados->buscarProdutos($busca);
}

    public function cadastrarCupom($codigo, $desconto, $validade){

        $cupom = new Cupom(
            $codigo,
            $desconto,
            $validade
        );

        $this->bancoDeDados->inserirCupom($cupom);
    }
    public function cadastrarLoja($nome, $descricao, $telefone, $email, $senha, $cidade, $imagem){

        $loja = new Loja(
             $nome,
             $descricao,
             $telefone,
             $email,
             $senha,
             $cidade,
             $imagem
        );

        $this->bancoDeDados->inserirLoja($loja);
    }
    public function retornarCupons(){
        return $this->bancoDeDados->retornarCupons();
    }

    /**
     * Verifica se o e-mail existe (cliente ou funcionario) e atualiza a senha.
     * Retorna 'cliente', 'funcionario' ou false.
     */
    public function redefinirSenha($email, $novaSenha){
        return $this->bancoDeDados->atualizarSenha($email, $novaSenha);
    }

    public function retornarClientes(){
        return $this->bancoDeDados->retornarClientes();
    }
    
    public function retornarFuncionarios(){
        return $this->bancoDeDados->retornarFuncionarios();
    }
    
    public function retornarLojas(){
        return $this->bancoDeDados->retornarLojas();
    }

    public function retornarProdutos(){
        return $this->bancoDeDados->retornarProdutos();
    }
    public function buscarProdutoPorId($id){
    return $this->bancoDeDados->buscarProdutoPorId($id);
    }
}
?>