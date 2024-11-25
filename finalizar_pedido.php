<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cafeteria_araujo";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


$data = json_decode(file_get_contents('php://input'), true);
$metodo = $data['metodo'];
$total = $data['total'];
$produtos = $data['produtos'];


$stmt = $conn->prepare("INSERT INTO pedidos (metodo_pagamento, total, produtos) VALUES (?, ?, ?)");
$produtos_json = json_encode($produtos);
$stmt->bind_param("sds", $metodo, $total, $produtos_json);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $conn->error]);
}

$stmt->close();
$conn->close();
?>