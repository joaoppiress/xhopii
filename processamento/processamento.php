<?php

session_start();
require_once __DIR__ . "/../model/BancoDeDados.php";
require_once __DIR__ . "/../model/Produto.php";
require_once __DIR__ . "/../controller/Controlador.php";

$controlador = new Controlador();

//Login
if(isset($_POST['inputEmailLog']) && isset($_POST['inputSenhaLog'])){

    $email = $_POST['inputEmailLog'];
    $senha = $_POST['inputSenhaLog'];

    $cliente = $controlador->loginCliente($email, $senha);
    

    if($cliente){
        $_SESSION['estaLogado'] = TRUE;
        $_SESSION['clienteNome'] = $cliente['nome'];
        header('Location:../view/home.php');
    } else {
        header('Location:../index.php?erro=1');
    }
    die();
}

//Cadastro de Cliente
if(isset($_POST['inputNome']) && isset($_POST['inputSobrenome']) && 
   isset($_POST['inputCPF']) && isset($_POST['inputDataNasc']) && 
   isset($_POST['inputTelefone']) && isset($_POST['inputEmail']) &&
   isset($_POST['inputSenha'])){

    $nome = $_POST['inputNome'];
    $sobrenome = $_POST['inputSobrenome'];
    $cpf = $_POST['inputCPF'];
    $dataNasc = $_POST['inputDataNasc'];
    $telefone = $_POST['inputTelefone'];
    $email = $_POST['inputEmail'];
    $senha = $_POST['inputSenha'];
    
    $controlador->cadastrarCliente($cpf, $nome, $sobrenome, $dataNasc, $telefone, $email, $senha);

    header('Location:../view/cad_cliente.php');
    die();
}

//Cadastro de Funcionário
if(isset($_POST['inputNomeFunc']) && isset($_POST['inputSobrenomeFunc']) && 
   isset($_POST['inputCPFFunc']) && isset($_POST['inputDataNascFunc']) && 
   isset($_POST['inputTelefoneFunc']) && isset($_POST['inputCargoFunc']) 
   && isset($_POST['inputEmailFunc']) && isset($_POST['inputSenhaFunc']) &&
   isset($_POST['inputSalarioFunc'])){

    $nome = trim($_POST['inputNomeFunc']);
    $sobrenome = trim($_POST['inputSobrenomeFunc']);
    $cpf = trim($_POST['inputCPFFunc']);
    $dataNasc = trim($_POST['inputDataNascFunc']);
    $telefone = trim($_POST['inputTelefoneFunc']);
    $cargo = trim($_POST['inputCargoFunc']);
    $email = trim($_POST['inputEmailFunc']);
    $senha = $_POST['inputSenhaFunc'];
    $salarioInformado = str_replace(',', '.', trim($_POST['inputSalarioFunc']));

    if (!is_numeric($salarioInformado) || (float) $salarioInformado < 0) {
        error_log('[DEBUG cadastro funcionario] Salario invalido recebido.');
        header('Location:../view/cad_funcionario.php?erro=salario');
        die();
    }

    try {
        $controlador->cadastrarFuncionario($cpf, $nome, $sobrenome, $dataNasc, $telefone, $cargo, $email, $senha, (float) $salarioInformado);
        header('Location:../view/cad_funcionario.php?cadastro=sucesso');
    } catch (Throwable $erro) {
        // Debug temporario: remover apos validar o cadastro no ambiente local.
        error_log('[DEBUG cadastro funcionario] ' . $erro->getMessage());
        header('Location:../view/cad_funcionario.php?erro=cadastro');
    }
    die();
}

//Cadastro de Produto
if (
    !empty($_POST['inputNomeProd']) &&
    !empty($_POST['inputFabricanteProd']) &&
    !empty($_POST['inputDescricaoProd']) &&
    !empty($_POST['inputValorProd']) &&
    !empty($_POST['inputQuantProd'])
) {
    $nome = trim($_POST['inputNomeProd']);
    $fabricante = trim($_POST['inputFabricanteProd']);
    $descricao = trim($_POST['inputDescricaoProd']);
    $valorInformado = str_replace(',', '.', trim($_POST['inputValorProd']));
    $quantidadeInformada = trim($_POST['inputQuantProd']);

    if (!is_numeric($valorInformado) || (float) $valorInformado < 0) {
        error_log('[DEBUG cadastro produto] Valor invalido recebido.');
        header('Location:../view/cadastrar_produto.php?erro=valor');
        die();
    }

    if (!is_numeric($quantidadeInformada) || (int) $quantidadeInformada < 0) {
        error_log('[DEBUG cadastro produto] Quantidade invalida recebida.');
        header('Location:../view/cadastrar_produto.php?erro=quantidade');
        die();
    }

    try {
        $controlador->cadastrarProduto(
            $nome,
            $fabricante,
            $descricao,
            (float) $valorInformado,
            (int) $quantidadeInformada
        );

        header('Location:../view/cadastrar_produto.php?cadastro=sucesso');
    } catch (Throwable $erro) {
        // Debug temporario: remover apos validar o cadastro no ambiente local.
        error_log('[DEBUG cadastro produto] ' . $erro->getMessage());
        header('Location:../view/cadastrar_produto.php?erro=cadastro');
    }

    die();
}

if(!empty($_POST['produtoselecionado'])){
    
}
?>
