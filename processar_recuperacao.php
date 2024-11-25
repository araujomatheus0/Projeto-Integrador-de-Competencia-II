<?php
session_start();


$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "cafeteria_araujo"; 


$con = new mysqli($servername, $username, $password, $dbname);


if ($con->connect_error) {
    die("Conexão falhou: " . $con->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $data = json_decode(file_get_contents("php://input"));
    $email = filter_var($data->email, FILTER_SANITIZE_EMAIL);

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'E-mail inválido.']);
        exit;
    }

    
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Nenhum usuário encontrado com esse e-mail.']);
        exit;
    }

    
    $nova_senha = bin2hex(random_bytes(4)); 
    $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT); 

    
    $update_query = "UPDATE users SET senha = ? WHERE email = ?";
    $update_stmt = $con->prepare($update_query);
    $update_stmt->bind_param("ss", $senha_hash, $email);
    $update_stmt->execute();

    
    $to = $email;
    $subject = "Sua nova senha";
    $message = "Sua nova senha é: " . $nova_senha;
    $headers = "From: no-reply@seusite.com\r\n"; 

    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(['success' => true, 'message' => 'Nova senha enviada para o seu e-mail.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao enviar o e-mail.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método de requisição inválido.']);
}


$con->close();
?>