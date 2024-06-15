<body>
    <div class="header">
        <a href="/home">HealthConnect</a>
    </div>
    <div class="container">
        <h2 class="title">Login Secretária</h2>
        <form method="POST" action="/loginSecretaria" id="form_login">
            <div class="campo">
                <label for="usuario">Usuário</label>
                <input type="text" id="usuario" name="usuario" class="input-container" placeholder="Digite seu usuário" required>
            </div>
            <div class="campo">
                <div class="label-container">
                    <label for="senha">Senha</label>
                </div>
                <input type="password" id="senha" name="senha" class="input-container" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" class="login-button">Login</button>
            <div class="spacer"></div> <!-- Elemento invisível para garantir o mesmo tamanho -->
        </form>
    </div>

    <script src="public/js/secretary/LoginSecretary.js"></script>
</body>
</html>
