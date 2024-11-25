<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" type="text/css" href="cadastros.css"> 
    <style>
        /* Estilos para o modal */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <script>
       
        function showMessage(message, type) {
            const messageBox = document.createElement('div');
            messageBox.className = `message-box ${type}`;
            messageBox.innerText = message;

            document.body.appendChild(messageBox);

           
            messageBox.style.animation = 'slideIn 0.5s forwards';

            
            setTimeout(() => {
                messageBox.style.animation = 'slideOut 0.5s forwards';
                setTimeout(() => {
                    messageBox.remove();
                }, 500); // Tempo para a animação de saída
            }, 3000);
        }

        // Mostrar mensagens da sessão
        window.onload = function() {
            <?php if (isset($_SESSION['error'])): ?>
                showMessage("<?php echo addslashes($_SESSION['error']); ?>", 'error');
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['success'])): ?>
                showMessage("<?php echo addslashes($_SESSION['success']); ?>", 'success');
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
        };

       
        function formatarTelefone(event) {
            let input = event.target;
            let value = input.value.replace(/\D/g, ''); 

            if (value.length > 10) {
                value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3'); 
            } else if (value.length > 5) {
                value = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3'); 
            } else if (value.length > 2) {
                value = value.replace(/(\d{2})(\d+)/, '($1) $2'); 
            } else if (value.length > 0) {
                value = value.replace(/(\d+)/, '($1'); 
            }

            input.value = value; 
        }

       
        function abrirModal() {
            document.getElementById("myModal").style.display = "block";
        }

      
        function fecharModal() {
            document.getElementById("myModal").style.display = "none";
        }

      
        function enviarEmailRecuperacao() {
            const email = document.getElementById("emailRecuperacao").value;
            if (email) {
                
                fetch('processar_recuperacao.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ email: email })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showMessage("E-mail de recuperação enviado com sucesso!", 'success');
                        fecharModal();
                    } else {
                        showMessage(data.message, 'error');
                    }
                })
                .catch(error => {
                    showMessage("Ocorreu um erro ao enviar o e-mail.", 'error');
                });
            } else {
                showMessage("Por favor, insira um e-mail válido.", 'error');
            }
        }
    </script>
</head>
  
<body>
    <div class="container">
        <h2 class="titulocadastro">Cadastro</h2>

        <form action="processar_cadastro.php" method="POST">
            <label>Nome:</label>
            <input type="text" name="nome" required>
            
            <label>Email:</label>
            <input type="email" name="email" required>
            
            <label>Senha:</label>
            <input type="password" name="senha" required>
            
            <label>Telefone:</label>
            <input type="tel" name="telefone" required oninput="formatarTelefone(event)"> <!-- Chama a função ao digitar -->

            <div>
                <a href="javascript:void(0);" class="forgot-password" onclick="abrirModal()">Esqueceu sua senha?</a>
            </div>
            <br>
            <button type="submit">Cadastrar</button>
        </form>

        
        <button onclick="window.location.href='login.php'" class="back-button">Voltar para Login</button>
    </div>

    
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fecharModal()">&times;</span>
            <h2>Recuperação de Senha</h2>
            <p>Insira seu e-mail para receber a nova senha:</p>
            <input type="email" id="emailRecuperacao" required placeholder="Seu e-mail">
            <button onclick="enviarEmailRecuperacao()">Enviar</button>
        </div>
    </div>
</body>
</html>