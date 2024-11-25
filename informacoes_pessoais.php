<?php
session_start();


if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); 
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'cafeteria_araujo');


if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


$usuario_id = $_SESSION['usuario_id'];
$stmt = $conn->prepare("SELECT nome, email, telefone, genero, consentimento, endereco_entrega FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$stmt->bind_result($usuario_nome, $usuario_email, $usuario_telefone, $usuario_genero, $usuario_consentimento, $usuario_endereco);
$stmt->fetch();
$stmt->close();


$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações Pessoais</title>
    <link rel="stylesheet" href="informacoespessoais.css"> 
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="informacoes_pessoais.php">Minhas Informações</a></li>
                <li><a href="editar_informacoes.php">Editar Informações</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Informações Pessoais</h1>
        <div class="informacoes-pessoais">
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($usuario_nome); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario_email); ?></p>
            <p><strong>Telefone:</strong> <?php echo htmlspecialchars($usuario_telefone); ?></p>
            <p><strong>Gênero:</strong> <?php echo htmlspecialchars($usuario_genero); ?></p>
            <p><strong>Consentimento:</strong> <?php echo $usuario_consentimento ? 'Sim' : 'Não'; ?></p>
            <p><strong>Endereço de Entrega:</strong> <?php echo htmlspecialchars($usuario_endereco); ?></p>
        </div>
        <a href="editar_informacoes.php">Editar Informações</a> 
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Sua Cafeteria. Todos os direitos reservados.</p>
    </footer>
</body>
</html>