<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reconfiguração de Senha</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>
<a href="/home" class="home-link">HOME</a>
<div class="container">
    <h2>Redefinir Senha</h2>
    <div class="form_login">
        <form action="/resetPassword" method="POST">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
            <div>
                <label for="new_password">Nova Senha:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div>
                <label for="confirm_password">Confirmar Nova Senha:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit">Confirmar Redefinição de Senha</button>
        </form>
    </div>
</div>

</body>
</html>
