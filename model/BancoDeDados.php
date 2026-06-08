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

    public function conectarBD(){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $conexao = mysqli_connect($this->host,$this->login,$this->senha,$this->dataBase);
        mysqli_set_charset($conexao, "utf8mb4");
        return($conexao);
    }
    
    public function inserirCliente($cpf, $nome, $sobrenome, $dataNasc, $telefone, $email, $senha, $foto){
        $conexao = $this->conectarBD();
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($conexao, "INSERT INTO cliente (cpf, nome, sobrenome, dataNascimento, telefone, email, senha, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssssssss", $cpf, $nome, $sobrenome, $dataNasc, $telefone, $email, $senhaHash, $foto);
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
    
        $stmt = mysqli_prepare($conexao, "INSERT INTO produto (nome, fabricante, descricao, valor, quantidade, imagem) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssdis", $nome, $fabricante, $descricao, $valor, $quantidade, $produto->get_Imagem());
        mysqli_stmt_execute($stmt);
    }
    
    public function inserirFuncionario($cpf, $nome, $sobrenome, $dataNasc, $telefone, $cargo, $email, $senha, $salario, $imagem){
        $conexao = $this->conectarBD();
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        try {
            $stmt = mysqli_prepare($conexao, "INSERT INTO funcionario (cpf, nome, sobrenome, dataNascimento, telefone, cargo, email, senha, salario, imagem) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "ssssssssds", $cpf, $nome, $sobrenome, $dataNasc, $telefone, $cargo, $email, $senhaHash, $salario, $imagem);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conexao);
            return true;
        } catch (mysqli_sql_exception $erro) {
            // Debug temporario: permite localizar falhas de schema ou constraint no log do PHP.
            error_log('[DEBUG inserirFuncionario] mysqli_error: ' . mysqli_error($conexao));
            mysqli_close($conexao);

            if ($erro->getCode() === 1062) {
               throw new RuntimeException($erro->getMessage(), 0, $erro);
            }

            throw $erro;
        }
    }

    
    public function retornarClientes(){
        $conexao = $this->conectarBD();
        $consulta = "SELECT * FROM cliente";
        $listaClientes = mysqli_query($conexao,$consulta);
        return $listaClientes;
    }
    
    public function retornarFuncionarios(){
        $conexao = $this->conectarBD();
        $consulta = "SELECT * FROM funcionario";
        $listaFuncionarios = mysqli_query($conexao,$consulta);
        return $listaFuncionarios;
    }
    
    public function retornarLojas(){
        $conexao = $this->conectarBD();
        $consulta = "SELECT * FROM loja";
        $listaLojas = mysqli_query($conexao,$consulta);
        return $listaLojas;
    }
    
    public function retornarProdutos(){
        $conexao = $this->conectarBD();
        $consulta = "SELECT * FROM produto";
        $listaProdutos = mysqli_query($conexao,$consulta);
        return $listaProdutos;
    }
    public function buscarProdutos($busca) {
    $conexao = $this->conectarBD();

    $termo = "%" . $busca . "%";

    $stmt = mysqli_prepare(
        $conexao,
        "SELECT * FROM produto
         WHERE nome LIKE ?
            OR fabricante LIKE ?
            OR descricao LIKE ?"
    );

    mysqli_stmt_bind_param($stmt, "sss", $termo, $termo, $termo);
    mysqli_stmt_execute($stmt);

    return mysqli_stmt_get_result($stmt);
}
    public function inserirCupom($cupom){
    
        $conexao = $this->conectarBD();
    
        $codigo = $cupom->getCodigo();
        $desconto = $cupom->getDesconto();
        $validade = $cupom->getValidade();
    
        $stmt = mysqli_prepare(
            $conexao,
            "INSERT INTO cupom (codigo, desconto, validade)
             VALUES (?, ?, ?)"
        );
    
        mysqli_stmt_bind_param(
            $stmt,
            "sds",
            $codigo,
            $desconto,
            $validade
        );
    
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public function inserirLoja($loja){

        $conexao = $this->conectarBD();
    
        $nome = $loja->getNome();
        $descricao = $loja->getDescricao();
        $telefone = $loja->getTelefone();
        $email = $loja->getEmail();
    
        $senha = password_hash($loja->getSenha(), PASSWORD_DEFAULT);
    
        $cidade = $loja->getCidade();
        $imagem = $loja->getImagem();
    
        $stmt = mysqli_prepare(
            $conexao,
            "INSERT INTO loja (nome, descricao, telefone, email, senha, cidade, imagem)
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
    
        mysqli_stmt_bind_param(
            $stmt,
            "sssssss",
            $nome,
            $descricao,
            $telefone,
            $email,
            $senha,
            $cidade,
            $imagem
        );
    
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conexao);
    }
    public function retornarCupons(){
    $conexao = $this->conectarBD();
    $consulta = "SELECT * FROM cupom";

    return mysqli_query($conexao, $consulta);
    }

    /**
     * Verifica se o e-mail existe em cliente ou funcionario
     * e atualiza a senha. Retorna 'cliente', 'funcionario' ou false.
     */
    public function atualizarSenha($email, $novaSenha){
        $conexao  = $this->conectarBD();
        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

        // --- verifica na tabela cliente ---
        $stmt = mysqli_prepare($conexao, "SELECT id FROM cliente WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($res) > 0) {
            mysqli_stmt_close($stmt);
            $upd = mysqli_prepare($conexao, "UPDATE cliente SET senha = ? WHERE email = ?");
            mysqli_stmt_bind_param($upd, "ss", $senhaHash, $email);
            mysqli_stmt_execute($upd);
            mysqli_stmt_close($upd);
            mysqli_close($conexao);
            return 'cliente';
        }
        mysqli_stmt_close($stmt);

        // --- verifica na tabela funcionario ---
        $stmt2 = mysqli_prepare($conexao, "SELECT id FROM funcionario WHERE email = ?");
        mysqli_stmt_bind_param($stmt2, "s", $email);
        mysqli_stmt_execute($stmt2);
        $res2 = mysqli_stmt_get_result($stmt2);

        if (mysqli_num_rows($res2) > 0) {
            mysqli_stmt_close($stmt2);
            $upd2 = mysqli_prepare($conexao, "UPDATE funcionario SET senha = ? WHERE email = ?");
            mysqli_stmt_bind_param($upd2, "ss", $senhaHash, $email);
            mysqli_stmt_execute($upd2);
            mysqli_stmt_close($upd2);
            mysqli_close($conexao);
            return 'funcionario';
        }
        mysqli_stmt_close($stmt2);
        mysqli_close($conexao);

        return false;
    }
    public function buscarProdutoPorId($id){
    $conexao = $this->conectarBD();

    $stmt = mysqli_prepare(
        $conexao,
        "SELECT * FROM produto WHERE id = ?"
    );

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    return mysqli_fetch_assoc(
        mysqli_stmt_get_result($stmt)
    );
    }

    }
    ?>