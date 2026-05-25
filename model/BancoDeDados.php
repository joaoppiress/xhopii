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
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $conexao = mysqli_connect($this->host,$this->login,$this->senha,$this->dataBase);
        mysqli_set_charset($conexao, "utf8mb4");
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
    
        $nome = $produto->get_Nome();
        $fabricante = $produto->get_Fabricante();
        $descricao = $produto->get_Descricao();
        $valor = $produto->get_Valor();
        $quantidade = $produto->get_Quantidade();
    
        $consulta = "INSERT INTO produto (nome, fabricante, descricao, valor, quantidade)
                     VALUES ('$nome', '$fabricante', '$descricao', '$valor', '$quantidade')";
    
        mysqli_query($conexao, $consulta);
    }
    
    public function inserirFuncionario($cpf, $nome, $sobrenome, $dataNasc, $telefone, $cargo, $email, $senha, $salario){
        $conexao = $this->conectarBD();
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        try {
            $stmt = mysqli_prepare($conexao, "INSERT INTO funcionario (cpf, nome, sobrenome, dataNascimento, telefone, cargo, email, senha, salario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "ssssssssd", $cpf, $nome, $sobrenome, $dataNasc, $telefone, $cargo, $email, $senhaHash, $salario);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conexao);
            return true;
        } catch (mysqli_sql_exception $erro) {
            // Debug temporario: permite localizar falhas de schema ou constraint no log do PHP.
            error_log('[DEBUG inserirFuncionario] mysqli_error: ' . mysqli_error($conexao));
            mysqli_close($conexao);

            if ($erro->getCode() === 1062) {
                throw new RuntimeException('CPF ou email ja cadastrado.', 0, $erro);
            }

            throw $erro;
        }
    }

    public function buscarFuncionarioPorEmail($email){
        $conexao = $this->conectarBD();
        $stmt = mysqli_prepare($conexao, "SELECT * FROM funcionario WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    }
    
    public function retornarClientes(){
        $conexao = $this->conectarBD();
        $consulta = "SELECT * FROM cliente";
        $listaClientes = mysqli_query($conexao,$consulta);
        return $listaClientes;
    }
    
    public function retornarFuncionario(){
        $conexao = $this->conectarBD();
        $consulta = "SELECT * FROM funcionario";
        $listaFuncionarios = mysqli_query($conexao,$consulta);
        return $listaFuncionarios;
    }
    
    public function retornarProdutos(){
        $conexao = $this->conectarBD();
        $consulta = "SELECT * FROM produto";
        $listaProdutos = mysqli_query($conexao,$consulta);
        return $listaProdutos;
    }

}

?>
