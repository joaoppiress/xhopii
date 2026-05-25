<?php

session_start();
require_once "../model/BancoDeDados.php";
require_once "../model/Produto.php";
require_once "../controller/Controlador.php";

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
   isset($_POST['inputTelefoneFunc']) && isset($_POST['inputEmailFunc']) &&
   isset($_POST['inputSalarioFunc'])){

    $nome = $_POST['inputNomeFunc'];
    $sobrenome = $_POST['inputSobrenomeFunc'];
    $cpf = $_POST['inputCPFFunc'];
    $dataNasc = $_POST['inputDataNascFunc'];
    $telefone = $_POST['inputTelefoneFunc'];
    $email = $_POST['inputEmailFunc'];
    $salario = $_POST['inputSalarioFunc'];
    
    #MODIFICAR PARA MVC CONTROLADOR
    inserirFuncionario($cpf, $nome, $sobrenome, $dataNasc, $telefone, $email, $salario);

    header('Location:../view/cadastroFuncionario.php');
    die();
}

//Cadastro de Produto
if(!empty($_POST['inputNomeProd']) && !empty($_POST['inputFabricanteProd']) && 
   !empty($_POST['inputDescricaoProd']) && !empty($_POST['inputValorProd'])){

    $nome = $_POST['inputNomeProd'];
    $fabricante = $_POST['inputFabricanteProd'];
    $descricao = $_POST['inputDescricaoProd'];
    $valor = $_POST['inputValorProd'];
    
    #CORRETO
    $controlador->cadastrarProduto($nome,$fabricante,$descricao,$valor);

    header('Location:../view/cadastroProduto.php');
    die();
}

if(!empty($_POST['produtoselecionado'])){
    
}
?>