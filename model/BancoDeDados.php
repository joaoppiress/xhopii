<?php

class BancoDeDados{

    private $host;
    private $login;
    private $senha;
    private $dataBase;

    public function __construct($Host, $Login, $Senha, $DataBase){
        $this->host = $Host;
        $this->login = $Login;
        $this->senha = $Senha;
        $this->dataBase = $DataBase;
    }

    //Métodos
    public function conectarBD(){
        $conexao = mysqli_connect($this->host,$this->login,$this->senha,$this->dataBase);
        return($conexao);
    }
    
    public function inserirCliente($cpf, $nome, $sobrenome, $dataNasc, $telefone, $email, $senha){
        $conexao = $this->conectarBD();
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($conexao, "INSERT INTO cliente (cpf, nome, sobrenome, dataNascimento, telefone, email, senha) VALUES (?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssssss", $cpf, $nome, $sobrenome, $dataNasc, $telefone, $email, $senhaHash);
        mysqli_stmt_execute($stmt);
    }

    public function buscarClientePorEmail($email){
        $conexao = $this->conectarBD();
        $stmt = mysqli_prepare($conexao, "SELECT * FROM cliente WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    }
    
    public function inserirProduto($produto){
        $conexao = $this->conectarBD();
        $consulta = "INSERT INTO produto (nome, fabricante, descricao, valor) 
                     VALUES ('$produto->get_Nome()',
                             '$produto->get_Fabricante()',
                             '$produto->get_Descricao()',
                             '$produto->get_Valor()')";
        mysqli_query($conexao,$consulta);
    }
    
    public function inserirFuncionario($cpf, $nome, $sobrenome, $dataNasc, $telefone, $email, $salario){
        $conexao = $this->conectarBD();
        $consulta = "INSERT INTO funcionario (cpf, nome, sobrenome, dataNascimento, telefone, email, salario) 
                     VALUES ('$cpf','$nome','$sobrenome','$dataNasc','$telefone','$email','$salario')";
        mysqli_query($conexao,$consulta);
    }
    
    public function retornarClientes(){
        $conexao = $this->conectarBD();
        $consulta = "SELECT * FROM cliente";
        $listaClientes = mysqli_query($conexao,$consulta);
        return $listaClientes;
    }
    
    public function retornarProdutos(){
        $conexao = $this->conectarBD();
        $consulta = "SELECT * FROM produto";
        $listaProdutos = mysqli_query($conexao,$consulta);
        return $listaProdutos;
    }

}

?>