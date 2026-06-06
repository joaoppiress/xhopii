<?php
require_once __DIR__ . '/../controller/Controlador.php';
$controlador = new Controlador();
$clientes    = $controlador->retornarClientes();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/cad_cliente.css">
    <link rel="stylesheet" href="../css/visu_clientes.css">
    <title>Xhopii – Clientes</title>
</head>
<body>
    <header>
        <section class="cabecalho-xhopii">
            <section class="cabecalho-xhopii-logo">
                <img src="../img/logo.png" alt="Logo Xhopii">
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
                <a href="visu_cupom.php">Ver Cupons</a>
            </nav>
        </section>
    </header>

    <main>
        <section class="conteudo-clientes">
            <h2 class="clientes-titulo">Clientes Cadastrados</h2>

            <?php if (mysqli_num_rows($clientes) === 0) : ?>
                <p class="sem-clientes">Nenhum cliente cadastrado ainda.</p>
            <?php else : ?>
                <section class="clientes-grid">
                    <?php while ($cliente = mysqli_fetch_assoc($clientes)) : ?>
                        <?php
                            $primeiraLetra = strtoupper(mb_substr($cliente['nome'], 0, 1, 'UTF-8'));
                            $temFoto = isset($cliente['foto'])
                                       && $cliente['foto'] !== ''
                                       && $cliente['foto'] !== 'sem-foto.png'
                                       && file_exists(__DIR__ . '/../img/clientes/' . $cliente['foto']);
                        ?>
                        <article class="cliente-card">
                            <section class="cliente-avatar">
                                <?php if ($temFoto) : ?>
                                    <img src="../img/clientes/<?= htmlspecialchars($cliente['foto']) ?>"
                                         alt="Foto de <?= htmlspecialchars($cliente['nome']) ?>">
                                <?php else : ?>
                                    <section class="cliente-avatar-placeholder"><?= $primeiraLetra ?></section>
                                <?php endif; ?>
                            </section>
                            <p class="cliente-nome"><?= htmlspecialchars($cliente['nome'] . ' ' . $cliente['sobrenome']) ?></p>
                            <p class="cliente-info"><strong>CPF:</strong> <?= htmlspecialchars($cliente['cpf']) ?></p>
                            <p class="cliente-info"><strong>Tel:</strong> <?= htmlspecialchars($cliente['telefone'] ?: '—') ?></p>
                            <p class="cliente-info"><strong>Email:</strong> <?= htmlspecialchars($cliente['email']) ?></p>
                        </article>
                    <?php endwhile; ?>
                </section>
            <?php endif; ?>
        </section>
    </main>

    <footer class="footer-completo">
        <section class="footer-container">
            <section class="footer-col">
                <h4>Atendimento ao Cliente</h4>
                <ul>
                    <li>Central de Ajuda</li>
                    <li>Como Comprar</li>
                    <li>Fale Conosco</li>
                </ul>
            </section>

            <section class="footer-col">
                <h4>Sobre a Xhopii</h4>
                <ul>
                    <li>Sobre Nós</li>
                    <li>Políticas Xhopii</li>
                    <li>Privacidade</li>
                </ul>
            </section>

            <section class="footer-col">
                <h4>Pagamento</h4>
                <section class="pay-grid"></section>
            </section>

            <section class="footer-col">
                <h4>Siga-nos</h4>
                <section class="social-item"><img src="https://cdn-icons-png.flaticon.com/512/174/174855.png" alt="Instagram"> Instagram</section>
                <section class="social-item"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Twitter"> Twitter</section>
                <section class="social-item"><img src="https://cdn-icons-png.flaticon.com/512/124/124010.png" alt="Facebook"> Facebook</section>
                <section class="social-item"><img src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png" alt="YouTube"> YouTube</section>
                <section class="social-item"><img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" alt="LinkedIn"> LinkedIn</section>
            </section>

            <section class="footer-col qr-code-area">
                <h4>Baixe nosso App</h4>
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Xhopii" class="qr-img" alt="QR Code">
                <section class="app-links">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Google Play">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Download_on_the_App_Store_Badge.svg" alt="App Store">
                </section>
            </section>
        </section>

        <p class="copyright-barra">
            &copy; 2023 Xhopii. Todos os direitos acadêmicos reservados
        </p>
    </footer>
</body>
</html>