<!-- Pronto = Pires-->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/ver_produtos.css">
    <title>Xhopii</title>
</head>
<body>
    <header>
        <section class ="cabecalho-xhopii">
            <section class="cabecalho-xhopii-logo">   
            <img src="../img/logo.png">
            <h1>Xhopii</h1>
            </section>
        </section>
        <section class="cabecalho-menu">
            <nav>
                <ul>
                    <a href="home.php">Home</a>
                    <a href="cad_cliente.php">Cadastro Cliente</a>
                    <a href="cad_funcionario.php">Cadastro Funcionário</a>
                    <a href="cadastrar_produto.php">Cadastro Produto</a>
                    <a href="visu_clientes.php">Ver Clientes</a>
                    <a href="visu_funcionarios.php">Ver Funcionários</a>
                    <a href="visu_produtos.php">Ver Produtos</a>
                </ul>
            </nav>
        </section>
    </header>
 <main class="container">
    <section class="conteudo">
        <section class="conteudo-imagens">
            <label class="btn-camisa">
                <input type="radio" name="camisa" value="preto">
                <img src="../img/produtos/produto1.png">
            </label>
            <label class="btn-camisa">
                <input type="radio" name="camisa" value="preto">
                <img src="../img/produtos/produto2.png">
            </label>
            <label class="btn-camisa">
                <input type="radio" name="camisa" value="preto">
                <img src="../img/produtos/produto3.png">
            </label>
            <label class="btn-camisa">
                <input type="radio" name="camisa" value="preto">
                <img src="../img/produtos/produto4.png">
            </label>
            <label class="btn-camisa">
                <input type="radio" name="camisa" value="preto">
                <img src="../img/produtos/produto5.png">
            </label>
        </section>
            <section class="conteudo-imagem">
                <img src="../img/produtos/produto1.png">
            </section>
    </section>
    <section class="especificacao">
        
    <section class="especificacao-sobre">
                    <h1>Camisa Desenvolvedor Front-End CSS</h1>
                    <h2>R$ 56,90</h2>
                    <p id="p1">171 peças disponíveis</p>
                    <p id="p2">Modelos:</p>
                    </section>
                    <section class="especificacao-modelos">
                        <label class="btn-modelo">
                            <input type="radio" name="modelo" value="preto">
                            <span>Preto</span>
                        </label>
                    
                        <label class="btn-modelo">
                            <input type="radio" name="modelo" value="azul">
                            <span>Azul</span>
                        </label>
                        <label class="btn-modelo">
                            <input type="radio" name="modelo" value="preto">
                            <span>Verde</span>
                        </label>
                    
                        <label class="btn-modelo">
                            <input type="radio" name="modelo" value="azul">
                            <span>Cinza</span>
                        </label>
                        <label class="btn-modelo">
                            <input type="radio" name="modelo" value="preto">
                            <span>Rosa</span>
                        </label>
                    
                    </section>
                    <section class="especificacao-sobre-tamanho">
                        <p>Tamanhos:</p>
                        </section>
                        <section class="especificacao-tamanho">
                            <label class="btn-tamanho">
                                <input type="radio" name="tamanho" value="p">
                                <span>P</span>
                            </label>
                        
                            <label class="btn-tamanho">
                                <input type="radio" name="tamanho" value="m">
                                <span>M</span>
                            </label>
                            <label class="btn-tamanho">
                                <input type="radio" name="tamanho" value="g">
                                <span>G</span>
                            </label>
                        
                            <label class="btn-tamanho">
                                <input type="radio" name="tamanho" value="gg">
                                <span>GG</span>
                            </label>
                        
                        </section>
                        <section class="especificacao-tamanho-selecionado">
                            <p>Tamanho selecionado: P</p>
                            <button class="btn-comprar">Comprar Agora</button>
                            </section>
                </section>
            </main>
</body>
</html>