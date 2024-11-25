<?php
session_start();

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Adiciona um item ao carrinho
if (isset($_POST['acao']) && $_POST['acao'] == 'adicionar') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $_SESSION['carrinho'][] = ['nome' => $nome, 'preco' => $preco];
}


if (isset($_POST['acao']) && $_POST['acao'] == 'remover') {
    $index = $_POST['index'];
    unset($_SESSION['carrinho'][$index]);
    $_SESSION['carrinho'] = array_values($_SESSION['carrinho']); // Reindexa o array
}


$total = 0;
foreach ($_SESSION['carrinho'] as $item) {
    $total += $item['preco'];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - Cafeteria</title>
    <link rel="stylesheet" type="text/css" href="carrinho.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        html, body {
            height: 100%; 
            margin: 0; 
            display: flex; 
            flex-direction: column; 
            align-items: center;
            background-color: #462b10;
        }

        .container {
            width: 100%; 
            
            padding: 20px;
            background-color: #d9d9d9; 
            border-radius: 8px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
            margin: 20px auto; 
            height: 100%;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            width: 90%; 
            text-align: center; 
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
            width: 90%;
        }

        .titulocarrinho {
            text-align: center;
        }

        .textototal {
            text-align: right;
        }

        .observacao {
            font-size: 20px;    
        }
    </style>
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="index.php#cardapio">Produtos</a></li>
            <li><a href="index.php#textocafe">Sobre Nós</a></li>
            <li><a href="contato.php">Contato</a></li>
            <li><a href="carrinho.php">Carrinho</a></li>
            
        </ul>
    </nav>
</header>

<div class="container">
    <h1 class="titulocarrinho">Carrinho de Compras</h1>

    <?php if (empty($_SESSION['carrinho'])): ?>
        <p>Seu carrinho está vazio.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Produto </th>
                    <th>Preço</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['carrinho'] as $index => $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['nome']); ?></td>
                        <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                        <td>
                            <form method="POST" action="carrinho.php" style="display:inline;">
                                <input type="hidden" name="acao" value="remover">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                <button type="submit" class="btn btn-danger">Remover</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h3 class="textototal">Total: R$ <?php echo number_format($total, 2, ',', '.'); ?></h3>

        <!-- Campo de observação -->
        <h4 class="observacao">Observações: </h4>
        <form method="POST" action="carrinho.php">
            <div class="form-group">
                <textarea class="form-control" name="observacao" rows="4" placeholder="Digite suas observações aqui..."></textarea>
            </div>
            </form>

        <br>
        <h4>Opções de Pagamento:</h4>
        <form method="POST" action="processar_pagamento.php">
            <div class="form-group">
                <label for="metodo">Escolha o método de pagamento:</label>
                <select class="form-control" id="metodo" name="metodo">
                    <option value="cartao">Cartão de Crédito</option>
                    <option value="pix">Pix</option>
                    <option value="dinheiro">Dinheiro</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Pagar</button>
        </form>
        <br>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2024 Nossa Cafeteria. Todos os direitos reservados.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>