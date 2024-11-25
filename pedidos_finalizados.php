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


$sql = "SELECT * FROM pedidos WHERE status = 'finalizado' ORDER BY data_pedido DESC";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "<!DOCTYPE html>
    <html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Pedidos Finalizados - Nossa Cafeteria</title>
        <link rel='stylesheet' href='estilo.css'> <!-- Certifique-se de que o caminho está correto -->
    </head>
    <body>
        <div class='container'>
            <h1>Pedidos Finalizados</h1>
            <table>
                <tr>
                    <th>ID do Pedido</th>
                    <th>Método de Pagamento</th>
                    <th>Total</th>
                    <th>Data do Pedido</th>
                </tr>";
    
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['metodo_pagamento'] . "</td>
                <td>R$ " . number_format($row['total'], 2, ',', '.') . "</td>
                <td>" . date('d/m/Y H:i:s', strtotime($row['data_pedido'])) . "</td>
              </tr>";
    }

    echo "</table>
        </div>
        <footer class='footer'>
            <p>&copy; " . date("Y") . " Nossa Cafeteria. Todos os direitos reservados.</p>
        </footer>
    </body>
    </html>";

} else {
    echo "<h2>Nenhum pedido finalizado encontrado.</h2>";
}

$conn->close();
?>