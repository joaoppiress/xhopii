<?php
require_once __DIR__ . '/../controller/Controlador.php';
$controlador = new Controlador();
$funcionarios = $controlador->retornarFuncionarios();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/cad_cliente.css">
    <link rel="stylesheet" href="../css/visu_funcionarios.css">
    <title>Xhopii – Funcionários</title>
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
        <section class="conteudo-funcionarios">
            <h2 class="funcionarios-titulo">Funcionários Cadastrados</h2>

            <?php if (mysqli_num_rows($funcionarios) === 0) : ?>
                <p class="sem-funcionarios">Nenhum funcionário cadastrado ainda.</p>
            <?php else : ?>
                <section class="funcionarios-grid">
                    <?php while ($funcionario = mysqli_fetch_assoc($funcionarios)) : ?>
                        <?php
                            $primeiraLetra = strtoupper(mb_substr($funcionario['nome'], 0, 1, 'UTF-8'));
                            $temFoto = isset($funcionario['imagem'])
                                       && $funcionario['imagem'] !== ''
                                       && $funcionario['imagem'] !== 'sem-foto.png'
                                       && file_exists(__DIR__ . '/../img/funcionarios/' . $funcionario['imagem']);
                        ?>
                        <article class="funcionario-card">
                            <section class="funcionario-avatar">
                                <?php if ($temFoto) : ?>
                                    <img src="../img/funcionarios/<?= htmlspecialchars($funcionario['imagem']) ?>"
                                         alt="Foto de <?= htmlspecialchars($funcionario['nome']) ?>">
                                <?php else : ?>
                                    <section class="funcionario-avatar-placeholder"><?= $primeiraLetra ?></section>
                                <?php endif; ?>
                            </section>
                            <p class="funcionario-nome"><?= htmlspecialchars($funcionario['nome'] . ' ' . $funcionario['sobrenome']) ?></p>
                            <p class="funcionario-info"><strong>CPF:</strong> <?= htmlspecialchars($funcionario['cpf']) ?></p>
                            <p class="funcionario-info"><strong>Cargo:</strong> <?= htmlspecialchars($funcionario['cargo'] ?: '—') ?></p>
                            <p class="funcionario-info"><strong>Email:</strong> <?= htmlspecialchars($funcionario['email']) ?></p>
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