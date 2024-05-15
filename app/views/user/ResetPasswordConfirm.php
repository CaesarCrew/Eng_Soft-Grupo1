<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Reconfiguração de Senha</title>
</head>
<body>
    <h2>Redefinir Senha</h2>
    <form action="PasswordOkay.php" method="POST">
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
</body>
</html>