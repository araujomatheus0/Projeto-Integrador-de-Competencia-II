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


$telefone = $_POST['telefone'];
$genero = $_POST['genero'];
$consentimento = isset($_POST['consentimento']) ? 1 : 0; 
$endereco_entrega = $_POST['endereco_entrega'];


$telefone = trim($telefone);
$endereco_entrega = trim($endereco_entrega);

if (empty($telefone) || empty($endereco_entrega)) {
    echo "Por favor, preencha todos os campos obrigatórios.";
    exit();
}


$stmt = $conn->prepare("UPDATE usuarios SET telefone = ?, genero = ?, consentimento = ?, endereco_entrega = ? WHERE id = ?");
$stmt->bind_param("ssssi", $telefone, $genero, $consentimento, $endereco_entrega, $usuario_id);

if ($stmt->execute()) {

    header("Location: informacoes_pessoais.php?atualizado=sucesso");
} else {
    echo "Erro ao atualizar as informações: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>