<body>
    <div class="header">
        <a href="/home">HealthConnect</a>
    </div>
    <div class="container">
        <h2 class="title">Redefinir Senha</h2>
        <form action="/resetPassword" method="POST" id="resetPasswordForm">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
            <div class="campo">
                <label for="new_password">Nova Senha:</label>
                <div class="input-container">
                    <input type="password" id="new_password" name="new_password" required>
                </div>
            </div>
            <div class="campo">
                <label for="confirm_password">Confirmar Nova Senha:</label>
                <div class="input-container">
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
            </div>
            <button type="submit" class="login-button">Confirmar Redefinição de Senha</button>
        </form>
    </div>
    <script src="public/js/user/ResetPasswordConfirm.js"></script>
</body>
</html>
