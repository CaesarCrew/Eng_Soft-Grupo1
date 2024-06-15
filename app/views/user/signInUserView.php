<body>
    <div class="container">
        <div class="header">
            <a href="/">HealthConnect</a>
        </div>
        <h2 class="title">Login Usuário</h2>
        <form id="form_login" method="POST" action="/login" onsubmit="logarUser(event)">
            <div class="campo">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="input-container" placeholder="Digite seu e-mail">
            </div>
            <div class="campo">
                <div class="label-container">
                    <label for="senha">Senha</label>
                    <a href="/sendMailPassword" class="forgot-password">Esqueceu sua senha?</a>
                </div>
                <input type="password" id="senha" name="senha" class="input-container" placeholder="Digite sua senha">
            </div>
            <!-- Alteramos o tipo de botão para button e adicionamos o evento onclick -->
            <button type="button" class="login-button" onclick="logarUser(event)">Login</button>
            <div class="account-check-container">
                <p class="no-account-text">Não tem conta? <a href="http://localhost/cadastro" class="signup-link">Cadastre-se</a></p>
                <p class="secretary-login-text">É secretária? <a href="http://localhost/loginSecretaria" class="secretary-login-link">Faça login aqui</a></p>
            </div>
            <div class="secretary-login-container"></div>
        </form>
    </div>
    <script src="public/js/user/signInUser.js"></script>
</body>
</html>
