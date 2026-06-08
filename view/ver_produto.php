<?php

require_once "../controller/Controlador.php";

$controlador = new Controlador();

$id = $_GET['id'];

$produto = $controlador->buscarProdutoPorId($id);

if(!$produto){
    die("Produto não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= $produto['nome'] ?></title>
    <link rel="stylesheet" href="../css/ver_produto.css">
</head>
<body>

<div class="produto-detalhe">

    <img src="../img/produtos/<?= $produto['imagem'] ?>">

    <div class="info">

        <h1><?= $produto['nome'] ?></h1>

        <p>
            <strong>Fabricante:</strong>
            <?= $produto['fabricante'] ?>
        </p>

        <p>
            <strong>Descrição:</strong>
            <?= $produto['descricao'] ?>
        </p>

        <p class="preco">
            R$ <?= number_format($produto['valor'],2,',','.') ?>
        </p>

        <p>
            <strong>Estoque:</strong>
            <?= $produto['quantidade'] ?>
        </p>

    </div>

</div>

</body>
</html>