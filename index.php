<?php
session_start(); 
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafeteria</title>
    <link rel="stylesheet" type="text/css" href="styleindex.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0 auto;
            padding: 0;
            width: 90%;
            background-color: #462b10;
        }
        .carousel-item img {
            width: 90%;
            height: 400px;
            object-fit: cover;
            margin: 0 auto;
        }

    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="#cardapio">Produtos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#textocafe">Sobre Nós</a></li>
                    <li class="nav-item"><a class="nav-link" href="contato.php">Contato</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="carrinho.php">Carrinho <i class="fas fa-shopping-cart"></i></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> <?php echo isset($_SESSION['usuario_nome']) ? htmlspecialchars($_SESSION['usuario_nome']) : 'Visitante'; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="informacoes_pessoais.php">Informações Pessoais</a>
                            <div class="dropdown-divider"></div>
                            <form action="logout.php" method="POST" style="display: inline;">
                                <button type="submit" class="dropdown-item" style="background: none; border: none; cursor: pointer;">
                                    Sair
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    
    <!-- Seção de Apresentação da Cafeteria -->
<section class="sobre-cafeteria">
    <h1 class="bemvindo">Bem-vindo à Nossa Cafeteria!</h1>
    <div class="sobre-cafeteria-conteudo">
        <img src="imagens/LOGO.jpg" alt="Imagem de Café" class="imagem-sobre-cafeteria" loading="lazy" />
        <p class='textocafeteria' id='textocafe'>
            Bem-vindo à Cafeteria Araújo, um espaço onde o aroma do café fresco se mistura com a paixão pela boa gastronomia e o aconchego de um ambiente acolhedor. 
            Fundada com o objetivo de proporcionar momentos especiais, nossa cafeteria é mais do que um simples local para saborear uma bebida quente; é um ponto de encontro para amigos, familiares e amantes do café. 
            Na Araújo, acreditamos que cada xícara conta uma história. Por isso, selecionamos os melhores grãos de café, provenientes de pequenas plantações que priorizam a sustentabilidade e a qualidade. 
            Nossa equipe é composta por baristas apaixonados, prontos para preparar seu café favorito com todo o carinho e dedicação. 
            Além do nosso café, oferecemos uma variedade de delícias artesanais, desde pães e bolos fresquinhos até opções de lanches saudáveis, todos preparados com ingredientes selecionados e receitas que valorizam o sabor caseiro. 
            Queremos que cada visita à nossa cafeteria seja uma experiência única, onde você possa relaxar, trabalhar ou simplesmente desfrutar de uma boa conversa. 
            Cafeteria Araújo – Onde cada xícara é uma nova história.
        </p>
    </div>
</section>

    <!-- Seção do Carrossel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="imagens/carrosel.jpg" class="d-block w-100" alt="Imagem 1" loading="lazy">
            </div>
            <div class="carousel-item">
                <img src="imagens/cafescarrosel.jpg" class="d-block w-100" alt="Imagem 2" loading="lazy">
            </div>
            <div class="carousel-item">
                <img src="imagens/carrossel_cafe.jpg" class="d-block w-100" alt="Imagem 3" loading="lazy">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Seção do Cardápio -->
    <h1 class="titulo-cardapio" id="cardapio">Nosso Cardápio</h1>
    <section class="cardapio">
        <div class="cardapio-item" data-nome="Café Especial" data-preco="5.00">
            <img src="imagens/cafe-antigo.jpg" alt="Café" loading="lazy" />
            <h3 class='textoitens'>Café Especial</h3>
            <p class='descitens'>Um café feito com grãos selecionados, torrado na hora.</p>
            <p class='precoitens'>Preço: R$ 5,00</p>
            <button class="btn adicionar-carrinho">Adicionar ao Carrinho</button>
        </div>
        <div class="cardapio-item" data-nome="Chá Gelado" data-preco="4.00">
            <img src="imagens/chaespecial.jpg" alt="Chá" loading="lazy" />
            <h3 class='textoitens'>Chá Gelado</h3>
            <p class='descitens'>Refrescante e perfeito para os dias quentes.</p>
            <p class='precoitens'>Preço: R$ 4,00</p>
            <button class="btn adicionar-carrinho">Adicionar ao Carrinho</button>
        </div>
        <div class="cardapio-item" data-nome="Bolo de Chocolate" data-preco="6.00">
            <img src="imagens/bolo.jpg" alt="Bolo" loading="lazy" />
            <h3 class='textoitens'>Bolo de Chocolate</h3>
            <p class='descitens'>Delicioso bolo de chocolate, perfeito para acompanhar seu café.</p>
            <p class='precoitens'>Preço: R$ 6,00</p>
            <button class="btn adicionar-carrinho">Adicionar ao Carrinho</button>
        </div>
        <div class="cardapio-item" data -nome="Sanduíche Natural" data-preco="7.00">
            <img src="imagens/sanduiche.jpg" alt="Sanduiche" loading="lazy" />
            <h3 class='textoitens'>Sanduíche Natural</h3>
            <p class='descitens'>Um lanche saudável e saboroso, feito com ingredientes frescos.</p>
            <p class='precoitens'>Preço: R$ 7,00</p>
            <button class="btn adicionar-carrinho">Adicionar ao Carrinho</button>
        </div>
        <div class="cardapio-item" data-nome="Torta Natural" data-preco="8.00">
            <img src="imagens/tortanatural.jpg" alt="Torta Natural" loading="lazy" />
            <h3 class='textoitens'>Torta Natural</h3>
            <p class='descitens'>Delicie-se com nossa torta natural, feita com uma massa leve e recheada com legumes frescos, ervas aromáticas e ingredientes saudáveis.</p>
            <p class='precoitens'>Preço: R$ 8,00</p>
            <button class="btn adicionar-carrinho">Adicionar ao Carrinho</button>
        </div>
        <div class="cardapio-item" data-nome="Pão de Queijo" data-preco="2.00">
            <img src="imagens/paodequeijo.jpeg" alt="Pão de Queijo" loading="lazy" />
            <h3 class='textoitens'>Pão De Queijo Grande</h3>
            <p class='descitens'>Descubra o sabor autêntico do pão de queijo grande, uma verdadeira iguaria brasileira.</p>
            <p class='precoitens'>Preço: R$ 2,00</p>
            <button class="btn adicionar-carrinho">Adicionar ao Carrinho</button>
        </div>
        <div class="cardapio-item" data-nome="Cesta Café da Manhã" data-preco="100.00">
            <img src="imagens/cafedamanha.jpg" alt="Cesta Café da Manhã" loading="lazy" />
            <h3 class='textoitens'>Cesta Café Da Manhã</h3>
            <p class='descitens'>Delicie-se com nossa Cesta de Café da Manhã, cuidadosamente preparada para tornar seu início de dia ainda mais especial.</p>
            <p class='precoitens'>Preço: R$ 100,00</p>
            <button class="btn adicionar-carrinho">Adicionar ao Carrinho</button>
        </div>
        <div class="cardapio-item" data-nome="Cesta de Casal" data-preco="130.00">
            <img src="imagens/cafedamanhacasal.jpg" alt="Cesta de Casal" loading="lazy" />
            <h3 class='textoitens'>Cesta De Casal</h3>
            <p class='descitens'>Surpreenda seu amor com nossa Cesta de Café da Manhã para Casal, uma seleção especial para tornar o início do dia ainda mais romântico e delicioso.</p>
            <p class='precoitens'>Preço: R$ 130,00</p>
            <button class="btn adicionar-carrinho">Adicionar ao Carrinho</button>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Nossa Cafeteria. Todos os direitos reservados.</p>
    </footer>

    <!-- Scripts do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.querySelectorAll('.adicionar-carrinho').forEach(button => {
            button.addEventListener('click', () => {
                const cardapioItem = button.parentElement;
                const nome = cardapioItem.getAttribute('data-nome');
                const preco = parseFloat(cardapioItem.getAttribute('data-preco'));

                // Envia o item para o carrinho.php
                fetch('carrinho.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `acao=adicionar&nome=${encodeURIComponent (nome)}&preco=${preco}`
                }).then(response => {
                    if (response.ok) {
                        alert(`${nome} adicionado ao carrinho!`);
                    } else {
                        alert('Erro ao adicionar ao carrinho.');
                    }
                });
            });
        });
    </script>    
</body>
</html>