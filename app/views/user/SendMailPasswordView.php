<body>
    <div class="container">
        <div class="header">
            <a href="/home">HealthConnect</a>
        </div>
        <h2 class="title">Redefinir Senha</h2>
        <form method="POST" action="/sendMailPassword" id="resetPasswordForm">
            <div class="campo">
                <label for="email">Seu Email:</label>
                <div class="input-container">
                    <input type="email" id="email" name="email" required>
                </div>
            </div>
            <button type="submit" class="login-button" name="resetPassword">Redefinir Senha</button>
        </form>
    </div>
    <script src="public/js/user/SendMailPassword.js"></script>
</body>
</html>
