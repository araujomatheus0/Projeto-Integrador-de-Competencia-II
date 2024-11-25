<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="stylelogin.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form action="processar_login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            
            <input type="submit" value="Entrar" class="btn">
            
            <p style="text-align: center; margin-top: 10px;">
                <a href="cadastro.php" class="cadastrar-link">Cadastre-se</a>
            </p>
        </form>
    </div>
</body>
</html>