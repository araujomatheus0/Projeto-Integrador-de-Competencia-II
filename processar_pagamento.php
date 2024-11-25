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


if (empty($_SESSION['carrinho'])) {
    header('Location: carrinho.php'); 
    exit();
}


if (isset($_POST['metodo'])) {
    $metodo = htmlspecialchars($_POST['metodo']); 
    $total = 0;

    
    foreach ($_SESSION['carrinho'] as $item) {
        $total += $item['preco'];
    }

    
    $codigoPix = "https://example.com/pagamento/" . uniqid(); 
    $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($codigoPix) . "&size=200x200";

    
    echo "<!DOCTYPE html>
    <html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Pagamento - Nossa Cafeteria</title>
        <link rel='stylesheet' href='pagar.css'> <!-- Certifique-se de que o caminho está correto -->
    </head>
    <body>
        <div class='container'>
            <h1>Confirmação de Pagamento</h1>
            <p>Você escolheu pagar com: <strong>" . $metodo . "</strong></p>
            <p>Valor total: <strong>R$ " . number_format($total, 2, ',', '.') . "</strong></p>";

    
    switch ($metodo) {
        case 'cartao':
            echo "<p>Por favor, insira os dados do seu cartão de crédito:</p>
                  <form action='processar_pagamento_cartao.php' method='POST' class='formulario-pagamento'>
                    <div>
                        <label for='numero_cartao'>Número do Cartão:</label>
                        <input type='text' id='numero_cartao' name='numero_cartao' required>
                    </div>
                    <div>
                        <label for='nome_titular'>Nome do Titular:</label>
                        <input type='text' id='nome_titular' name='nome_titular' required>
                    </div>
                    <div>
                        <label for='data_validade'>Data de Validade (MM/AA):</label>
                        <input type='text' id='data_validade' name='data_validade' required placeholder='MM/AA'>
                    </div>
                    <div>
                        <label for='cvv'>Código de Segurança (CVV):</label>
                        <input type='text' id='cvv' name='cvv' required>
                    </div>
                    <input type='hidden' name='total' value='" . number_format($total, 2, '.', '') . "'>
                    <button type='submit' class='btn'>Pagar</button>
                  </form>";
            break;
        case 'pix':
            echo "<p>Por favor, utilize o QR Code abaixo para efetuar o pagamento via Pix:</p>";
            echo "<img src='" . $qrCodeUrl . "' alt='QR Code para pagamento' class='qr-code' />"; 
            break;
        case 'dinheiro':
            echo "<p>Por favor, tenha o valor exato em dinheiro para o pagamento.</p>";
            break;
        default:
            echo "<p>Método de pagamento inválido.</p>";
            break;
    }

    // Botão para finalizar o pedido
    echo "<button type='button' class='btn finalizar-pedido' onclick='finalizarPedido()'>Finalizar Pedido </button>";

    echo "<p><a href='carrinho.php' class='btn voltar'>Voltar ao Carrinho</a></p>
        </div>
        <footer class='footer'>
            <p>&copy; " . date("Y") . " Nossa Cafeteria. Todos os direitos reservados.</p>
        </footer>
        <script>
        function finalizarPedido() {
            let metodo = '" . $metodo . "';
            let total = '" . number_format($total, 2, '.', '') . "';
            let produtos = " . json_encode($_SESSION['carrinho']) . ";

            fetch('finalizar_pedido.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ metodo, total, produtos }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Pedido finalizado com sucesso!');
                    window.location.href = 'carrinho.php';
                } else {
                    alert('Erro ao finalizar o pedido: ' + data.message);
                }
            });
        }
        </script>
    </body>
    </html>";

} else {
    
    header('Location: carrinho.php');
    exit();
}
?>