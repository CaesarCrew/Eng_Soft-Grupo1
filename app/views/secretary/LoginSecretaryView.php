<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Secretaria</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: rgb(164, 70, 238);
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
        .form_login input[type="text"],
        .form_login input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form_login input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #0056b3; /* Nova cor para o botão "Enviar" */
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        /* Estilo para o link "HOME" */
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
    <h1>Login Secretaria</h1>
    <div class="form_login">
        <form method="POST" action="/loginSecretaria" id="form_login">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" required><br>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br>
            <input type="submit" name="submit" value="Enviar">
        </form>
    </div>
</div>

<script>
    document.getElementById("form_login").addEventListener("submit", async (event) => {
    event.preventDefault();

    const loginData = {
        usuario: document.getElementById("usuario").value,
        senha: document.getElementById("senha").value
    };

    try {
        const response = await fetch('http://localhost/loginSecretaria', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(loginData)
        });

        const text = await response.text();
        console.log('Raw response:', text);

        const data = JSON.parse(text);
        if (data.status === 'success') {
            window.location.replace('http://localhost/homeSecretaria');
        } else {
            console.error('Erro de login:', data.message);
        }
    } catch (error) {
        console.error('Erro:', error);
    }
});
</script>

</body>
</html>
