<?php
session_start();


$host = 'localhost'; 
$db = 'cafeteria_araujo'; 
$user = 'root'; 
$pass = ''; 


$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}


if (isset($_POST['adicionar'])) {
    $idProduto = $_POST['id'];
    $sql = "SELECT * FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idProduto);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $produtoSelecionado = $resultado->fetch_assoc();

    if ($produtoSelecionado) {
        $_SESSION['carrinho'][] = $produtoSelecionado; 
    }
}


$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Cafeteria</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

    <header>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="#cardapio">Produtos</a></li>
                <li><a href="sobre_nos.php">Sobre Nós</a></li>
                <li><a href="contato.php">Contato</a></li>
                <li><a href="carrinho.php">Carrinho (<?php echo count($_SESSION['carrinho']); ?>)</a></li>
            </ul>
        </nav>
    </header>

    <h1>Produtos</h1>

    <div class="produtos">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($produto = $result->fetch_assoc()): ?>
                <div class="produto">
                    <img src="<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['nome']; ?>">
                    <h3><?php echo $produto['nome']; ?></h3>
                    <p>Preço: R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
                        <button type="submit" name="adicionar">Adicionar ao Carrinho</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Nenhum produto encontrado.</p>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2023 Nossa Cafeteria. Todos os direitos reservados.</p>
    </footer>

</body>
</html>

<?php
$conn->close(); 
?>