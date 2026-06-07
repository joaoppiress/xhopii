<?php
require_once "../controller/Controlador.php";
$controlador = new Controlador();
$listaCupons = $controlador->retornarCupons();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Cupons</title>
    <link rel="stylesheet" href="../css/visu_cupom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<header>
        <section class="cabecalho-xhopii">
            <section class="cabecalho-xhopii-logo">   
                <img src="../img/logo.png">
                <h1>Xhopii</h1>
            </section>
            <section class="cabecalho-xhopii-sair">
                <a href="login.php">Sair</a>
            </section>
        </section>
        <section class="cabecalho-menu">
           <nav>
    <a href="home.php">Home</a>
    <a href="cad_cliente.php">Cadastrar Cliente</a>
    <a href="cad_funcionario.php">Cadastrar Funcionário</a>
    <a href="cadastrar_produto.php">Cadastrar Produto</a>
    <a href="cad_loja.php">Cadastrar Loja</a>
    <a href="cad_cupom.php">Cadastrar Cupom</a>
    <a href="visu_clientes.php">Ver Clientes</a>
    <a href="visu_funcionarios.php">Ver Funcionários</a>
    <a href="visu_produtos.php">Ver Produtos</a>
    <a href="visu_lojas.php">Ver Lojas</a>
    <a href="visu_cupons.php">Ver Cupons</a>
           </nav>
        </section>
    </header>

<main>

    <section class="titulo">
        <h2>Cupons Cadastrados</h2>
    </section>

    <section class="tabela-container">

        <table>

            <tr>
                <th>Código</th>
                <th>Desconto</th>
                <th>Validade</th>
            </tr>

            <?php
            while($cupom = mysqli_fetch_assoc($listaCupons)){
            ?>

            <tr>
                <td><?php echo $cupom['codigo']; ?></td>
                <td><?php echo $cupom['desconto']; ?>%</td>
                <td><?php echo date("d/m/Y", strtotime($cupom['validade'])); ?></td>
            </tr>

            <?php
            }
            ?>

        </table>

    </section>

</main>

</body>
</html>