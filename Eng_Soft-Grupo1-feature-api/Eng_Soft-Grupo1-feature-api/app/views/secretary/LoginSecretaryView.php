<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Secretaria</title>
    <style>
        
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

<script src="public/js/secretary/LoginSecretary.js"></script>

</body>

</html>
