<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato - Cafeteria</title>
    <link rel="stylesheet" type="text/css" href="contatos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0 auto;
            padding: 0;
            width: 90%;
            background-color: #462b10;
        }
        .form-container {
            background-color: #d9d9d9;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .info-estabelecimento {
            margin-top: 40px;
            background-color: #d9d9d9;
            padding: 20px;
            border-radius: 5px;
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

    <div class="form-container">
        <h1>Contato</h1>
        <form action="contato.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="mensagem">Mensagem:</label>
                <textarea class="form-control" id="mensagem" name="mensagem" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = htmlspecialchars($_POST['nome']);
        $email = htmlspecialchars($_POST['email']);
        $mensagem = htmlspecialchars($_POST['mensagem']);

        
        echo "<div class='alert alert-success mt-3'>Obrigado, $nome! Sua mensagem foi enviada com sucesso.</div>";
    }
    ?>

    <div class="info-estabelecimento">
        <h2>Informações do Estabelecimento</h2>
        <p><strong>Nome da Cafeteria:</strong> Araujo Café</p>
        <p><strong>Endereço:</strong> Rua das Flores, 123 - Centro, Cidade, Estado, CEP 00000-000</p>
        <p><strong>Telefone:</strong> (00) 1234-5678</p>
        <p><strong>Horário de Funcionamento:</strong> Segunda a Sexta: 08:00 - 18:00 | Sábado: 09:00 - 16:00 | Domingo: Fechado</p>
    </div>
    <br>
    <footer>
        <p>&copy; 2024 Nossa Cafeteria. Todos os direitos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>