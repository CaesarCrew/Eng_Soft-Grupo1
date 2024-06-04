<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: rgb(164, 70, 238);
            position: relative;
        }
        .container {
            text-align: center;
        }
        .form_login {
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 0 auto;
            position: relative;
        }
        .form_login label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .form_login input[type="email"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form_login button[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #0056b3;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        a.home-link {
            position: absolute;
            top: 20px;
            left: 20px;
            cursor: pointer;
            color: white;
            text-decoration: none; /* Removendo sublinhado do link */
            font-size: 18px; /* Ajustando o tamanho da fonte */
        }
    </style>
</head>
<body>
<a href="/home" class="home-link">HOME</a>
<div class="container">
    <h1>Redefinir Senha</h1>
    <div class="form_login">
        <form method="POST" action="/sendMailPassword" id="resetPasswordForm">
            <label for="email">Seu Email:</label>
            <input type="email" id="email" name="email" required><br>
            <button type="submit" name="resetPassword">Redefinir Senha</button>
        </form>
    </div>
</div>
<script>
document.getElementById('resetPasswordForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const email = document.getElementById('email').value;
    
    try {
        const response = await fetch('http://localhost/sendMailPassword', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ email: email })
        });
        const text = await response.text();
        const result = JSON.parse(text);
        
        if (result.status === 'success') {
            alert(result.message);
        } else {
            alert('Erro: ' + result.message);
        }
    } catch (error) {
        console.error('Erro:', error);
        alert('Ocorreu um erro ao tentar enviar o email de redefinição de senha.');
    }
});
</script>
</body>
</html>
