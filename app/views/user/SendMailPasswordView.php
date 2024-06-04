<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <style>
       
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
<script src="public/js/user/SendMailPassword.js"></script>
</body>
</html>
