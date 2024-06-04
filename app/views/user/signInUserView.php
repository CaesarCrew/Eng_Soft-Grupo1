<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Usuário</title>
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
            background-color: #0056b3;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .form_login .link_cadastrar, .form_login .link_esqueceu {
            float: right;
        }
        .form_login .link_cadastrar a, .form_login .link_esqueceu a {
            color: #007BFF;
            text-decoration: none;
            font-size: 12px;
        }
        .form_login .link_cadastrar a:hover, .form_login .link_esqueceu a:hover {
            text-decoration: underline;
        }
        .secretary_login {
            margin-top: 30px;
            width: 300px;
            padding: 20px;
            border-radius: 15px;
            background-color: #622A8F;
        }
        .secretary_login a {
            color: white;
            text-decoration: none;
            display: inline-block;
        }
        .secretary_login:hover {
            cursor: pointer;
            margin: 1px solid #622A8F;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Login Usuário</h1>
    <div class="form_login">
        <form id ="form_login" method="POST" action="/login"  onsubmit="logarUser(event)">
            <label for="email">E-mail:</label>
            <input type="text" id="email" name="email" required><br>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br>
            <input type="submit" name="submit" value="Enviar">
        </form>
        <div class="link_cadastrar">
            <a href="http://localhost/cadastro">Não têm conta? Cadastre-se</a>
        </div>
        <br>
        <div class="link_esqueceu">
            <a href="/sendMailPassword">Esqueceu sua senha?</a>
        </div>
    </div>
    <div class="secretary_login">
        <a href="http://localhost/loginSecretaria" class="secretary_button">Você é Secretária? Faça Login aqui</a>
    </div>
</div>
<script>
    async function logarUser(){
        event.preventDefault();

        const form = document.getElementById("form_login");
        const formData = new FormData(form);

        try{ 
                const response = await fetch("http://localhost/login", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        email: formData.get('email'),
                        senha: formData.get('senha')
                    })
                })
                const text = await response.text();

                const data = JSON.parse(text);
                if (data.status === 'success') {
                    console.log("login realizado com sucesso")
                    window.location.replace('http://localhost/home');
                
                } else {
                    alert('Erro  ao realizar login ');
                    console.error('Erro ao logar:', data.message);
                }
            } catch (error) {
                console.error('Erro:', error);
            }
    }
</script>
</body>
</html>
