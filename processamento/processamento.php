<?php

session_start();
require_once __DIR__ . "/../model/BancoDeDados.php";
require_once __DIR__ . "/../model/Produto.php";
require_once __DIR__ . "/../controller/Controlador.php";
require_once __DIR__ . "/../model/Cupom.php";
require_once __DIR__ . "/../model/Funcionario.php";
require_once __DIR__ . "/../model/Loja.php";

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
if(
   isset($_POST['inputNome']) &&
   isset($_POST['inputSobrenome']) &&
   isset($_POST['inputCPF']) &&
   isset($_POST['inputDataNasc']) &&
   isset($_POST['inputTelefone']) &&
   isset($_POST['inputEmail']) &&
   isset($_POST['inputSenha'])
){

    $nome = $_POST['inputNome'];
    $sobrenome = $_POST['inputSobrenome'];
    $cpf = $_POST['inputCPF'];
    $dataNasc = $_POST['inputDataNasc'];
    $telefone = $_POST['inputTelefone'];
    $email = $_POST['inputEmail'];
    $senha = $_POST['inputSenha'];

    $nomeFoto = "sem-foto.png";

    if(
        isset($_FILES['fotoCliente']) &&
        $_FILES['fotoCliente']['error'] == 0
    ){

        $pastaDestino = __DIR__ . "/../img/clientes/";

        if(!is_dir($pastaDestino)){
            mkdir($pastaDestino,0777,true);
        }

        $nomeFoto = time() . "_" .
                    basename($_FILES['fotoCliente']['name']);

        move_uploaded_file(
            $_FILES['fotoCliente']['tmp_name'],
            $pastaDestino . $nomeFoto
        );
    }

    $controlador->cadastrarCliente(
        $cpf,
        $nome,
        $sobrenome,
        $dataNasc,
        $telefone,
        $email,
        $senha,
        $nomeFoto
    );

    header('Location:../view/cad_cliente.php?cadastro=sucesso');
    die();
}

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

    $nomeFoto = "sem-foto.png";

    if(
        isset($_FILES['imagemFuncionario']) &&
        $_FILES['imagemFuncionario']['error'] == 0
    ){

        $pastaDestino = __DIR__ . "/../img/funcionarios/";

        if(!is_dir($pastaDestino)){
            mkdir($pastaDestino,0777,true);
        }

        $nomeFoto = time() . "_" .
                    basename($_FILES['imagemFuncionario']['name']);

        move_uploaded_file(
            $_FILES['imagemFuncionario']['tmp_name'],
            $pastaDestino . $nomeFoto
        );
    }
    $controlador->cadastrarFuncionario(
        $cpf,
        $nome,
        $sobrenome,
        $dataNasc,
        $telefone,
        $cargo,
        $email,
        $senha,
        (float) $salarioInformado,
        $nomeFoto
    );
    if (!is_numeric($salarioInformado) || (float) $salarioInformado < 0) {
        error_log('[DEBUG cadastro funcionario] Salario invalido recebido.');
        header('Location:../view/cad_funcionario.php?erro=salario');
        die();
    }

 try {
    $controlador->cadastrarFuncionario(
        $cpf,
        $nome,
        $sobrenome,
        $dataNasc,
        $telefone,
        $cargo,
        $email,
        $senha,
        (float) $salarioInformado,
        $nomeFoto
    );

    header('Location:../view/cad_funcionario.php?cadastro=sucesso');
    exit;

} catch (Throwable $erro) {

    if (str_contains($erro->getMessage(), 'Duplicate entry')) {
        header('Location:../view/cad_funcionario.php?erro=duplicado');
        exit;
    }

    header('Location:../view/cad_funcionario.php?erro=cadastro');
    exit;
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
    $valor = str_replace(',', '.', trim($_POST['inputValorProd']));
    $quantidade = trim($_POST['inputQuantProd']);
    $imagem = $_FILES['imagemProduto'];

    $pastaDestino = __DIR__ . "/../img/produtos/";

    if (!is_dir($pastaDestino)) {
        mkdir($pastaDestino, 0777, true);
    }

    $nomeImagem = basename($imagem['name']);
    $caminhoDestino = $pastaDestino . $nomeImagem;

    if (!file_exists($caminhoDestino)) {
        move_uploaded_file($imagem['tmp_name'], $caminhoDestino);
    }

    if (!is_numeric($valor) || (float) $valor < 0) {
        error_log('[DEBUG cadastro produto] Valor invalido recebido.');
        header('Location:../view/cadastrar_produto.php?erro=valor');
        die();
    }

    if (!is_numeric($quantidade) || (int) $quantidade < 0) {
        error_log('[DEBUG cadastro produto] Quantidade invalida recebida.');
        header('Location:../view/cadastrar_produto.php?erro=quantidade');
        die();
    }

    try {
        $controlador->cadastrarProduto($nome, $fabricante, $descricao, (float) $valor, (int) $quantidade, $nomeImagem);
        header('Location:../view/cadastrar_produto.php?cadastro=sucesso');
    } catch (Throwable $erro) {
    echo "<pre>";
    print_r($erro);
    echo "</pre>";
    die();
}

    die();
}

if(!empty($_POST['produtoselecionado'])){
    
}

//Cadastro de Cupom
if(
    isset($_POST['inputCodigoCupom']) &&
    isset($_POST['inputDescontoCupom']) &&
    isset($_POST['inputValidadeCupom'])
){

    $codigo = trim($_POST['inputCodigoCupom']);
    $desconto = trim($_POST['inputDescontoCupom']);
    $validade = trim($_POST['inputValidadeCupom']);

    $controlador->cadastrarCupom(
        $codigo,
        $desconto,
        $validade
    );

    header('Location:../view/cad_cupom.php?cadastro=sucesso');
    die();
}

if(
    isset($_POST['inputNomeLoja']) &&
    isset($_POST['inputDescricaoLoja']) &&
    isset($_POST['inputTelefoneLoja']) &&
    isset($_POST['inputEmailLoja']) &&
    isset($_POST['inputSenhaLoja']) &&
    isset($_POST['inputCidadeLoja'])
){

    $nome = trim($_POST['inputNomeLoja']);
    $descricao = trim($_POST['inputDescricaoLoja']);
    $telefone = trim($_POST['inputTelefoneLoja']);
    $email = trim($_POST['inputEmailLoja']);
    $senha = $_POST['inputSenhaLoja'];
    $cidade = trim($_POST['inputCidadeLoja']);

    $nomeImagem = "sem-foto.png";

    if(
        isset($_FILES['imagemLoja']) &&
        $_FILES['imagemLoja']['error'] == 0
    ){
        $pastaDestino = __DIR__ . "/../img/lojas/";

        if(!is_dir($pastaDestino)){
            mkdir($pastaDestino, 0777, true);
        }

        $nomeImagem = time() . "_" . basename($_FILES['imagemLoja']['name']);

        move_uploaded_file(
            $_FILES['imagemLoja']['tmp_name'],
            $pastaDestino . $nomeImagem
        );
    }

    try {
        $controlador->cadastrarLoja(
            $nome,
            $descricao,
            $telefone,
            $email,
            $senha,
            $cidade,
            $nomeImagem
        );

        header('Location:../view/cad_loja.php?cadastro=sucesso');
        exit;

    } catch (Throwable $erro) {
        if (str_contains($erro->getMessage(), 'Duplicate entry')) {
            header('Location:../view/cad_loja.php?erro=duplicado');
            exit;
        }

        header('Location:../view/cad_loja.php?erro=cadastro');
        exit;
    }
}

// Redefinir Senha
if(
    isset($_POST['inputEmailRedef']) &&
    isset($_POST['inputNovaSenha']) &&
    isset($_POST['inputConfirmaSenha'])
){
    $email         = trim($_POST['inputEmailRedef']);
    $novaSenha     = $_POST['inputNovaSenha'];
    $confirmaSenha = $_POST['inputConfirmaSenha'];

    if(empty($email) || empty($novaSenha) || empty($confirmaSenha)){
        header('Location:../view/redefinir.php?erro=campos_vazios');
        die();
    }

    if($novaSenha !== $confirmaSenha){
        header('Location:../view/redefinir.php?erro=senhas_nao_conferem');
        die();
    }

    $resultado = $controlador->redefinirSenha($email, $novaSenha);

    if($resultado){
        header('Location:../view/redefinir.php?sucesso=1');
    } else {
        header('Location:../view/redefinir.php?erro=email_nao_encontrado&email=' . urlencode($email));
    }
    die();
}
?>
