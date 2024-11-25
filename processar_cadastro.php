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


$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); 
$telefone = $_POST['telefone'];


$stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $_SESSION['error'] = "Usuário já cadastrado.";
    header("Location: cadastro.php");
    exit();
} else {
    
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, telefone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $email, $senha, $telefone);

    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Cadastro feito com sucesso!";
        header("Location: cadastro.php"); 
        exit();
    } else {
        $_SESSION['error'] = "Erro ao cadastrar: " . $stmt->error;
        header("Location: cadastro.php"); 
        exit();
    }
}


$stmt->close();
$conn->close();
?>