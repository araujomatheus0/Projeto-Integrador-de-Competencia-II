<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'cafeteria_araujo');

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    
    $stmt = $conn->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nome, $senha_hash);
        $stmt->fetch();

        
        if (password_verify($senha, $senha_hash)) {
            
            $_SESSION['usuario_id'] = $id;
            $_SESSION['usuario_nome'] = $nome;
            header("Location: index.php");
            exit();
        } else {
            
            $_SESSION['error'] = "Senha incorreta!";
            header("Location: login.php");
            exit();
        }
    } else {
        
        $_SESSION['error'] = "Usuário não encontrado!";
        header("Location: login.php");
        exit();
    }

    
    $stmt->close();
}


$conn->close();
?>