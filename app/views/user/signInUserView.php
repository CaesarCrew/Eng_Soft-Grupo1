<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Usuário</title>
    <style>
      
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
<script src="public/js/user/signInUser.js"></script>
</body>
</html>
