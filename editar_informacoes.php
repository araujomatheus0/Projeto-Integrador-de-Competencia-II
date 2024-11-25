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
    <title>Editar Informações</title>
    <link rel="stylesheet" href="editarinformacoes.css"> 
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
        <h1>Editar Informações</h1>
        <form action="atualizar_informacoes.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario_nome); ?>" disabled>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario_email); ?>" disabled>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($usuario_telefone); ?>">

            <label for="genero">Gênero:</label>
            <select id="genero" name="genero">
                <option value="Masculino" <?php echo $usuario_genero == 'Masculino' ? 'selected' : ''; ?>>Masculino</option>
                <option value="Feminino" <?php echo $usuario_genero == 'Feminino' ? 'selected' : ''; ?>>Feminino</option>
                <option value="Outro" <?php echo $usuario_genero == 'Outro' ? 'selected' : ''; ?>>Outro</option>
            </select>

            <label for="consentimento">Consentimento:</label>
            <input type="checkbox" id="consentimento" name="consentimento" value="1" <?php echo $usuario_consentimento ? 'checked' : ''; ?>>

            <label for="endereco_entrega">Endereço de Entrega:</label>
            <input type="text" id="endereco_entrega" name="endereco_entrega" value="<?php echo htmlspecialchars($usuario_endereco); ?>">

            <button type="submit">Atualizar Informações</button>
        </form>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Sua Cafeteria. Todos os direitos reservados.</p>
    </footer>
</body>
</html>