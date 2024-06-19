
<body>
    <div class="container">
        <div class="container__apresentacao">
            <div class="background-image">
                <img src="public/css/user/BackgroundMedium.png" alt="BackgroundMedium" class="container__apresentacao__background">
                <h1 class="apresentacao">Bem-vindo. <br> Comece sua jornada agora com nosso sistema de gestão!</h1>
            </div>
        </div>

        <div class="container__registro">
            <div class="form__titulo">
                <h1>Cadastrar</h1>
            </div>
            <div class="container__registro__form">
                <form id="signupForm" method="POST" class="form">
                    <div class="half-width">
                        <label for="nome" class="input-label">Nome</label>
                        <input type="text" id="nome" name="nome" placeholder="Nome" required>
                    </div>
                    <div class="half-width">
                        <label for="cep" class="input-label">CEP</label>
                        <input type="text" id="cep" name="cep" placeholder="CEP" maxlength="8" required>
                    </div>
                    <div class="half-width">
                        <label for="senha" class="input-label">Senha</label>
                        <input type="password" id="senha" name="senha" placeholder="Senha" required>
                    </div>
                    <div class="half-width">
                        <label for="logradouro" class="input-label">Logradouro</label>
                        <input type="text" id="logradouro" name="logradouro" placeholder="Logradouro" required>
                    </div>
                    <div class="half-width">
                        <label for="email" class="input-label">Email</label>
                        <input type="email" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="half-width">
                        <label for="numero" class="input-label">Número</label>
                        <input type="text" id="numero" name="numero" placeholder="Número" required>
                    </div>
                    <div class="half-width">
                        <label for="telefone" class="input-label">Telefone</label>
                        <input type="text" id="telefone" name="telefone" placeholder="Telefone" required maxlength="12">
                    </div>
                    <div class="half-width">
                        <label for="complemento" class="input-label">Complemento</label>
                        <input type="text" id="complemento" name="complemento" placeholder="Complemento">
                    </div>
                    <div class="half-width">
                        <label for="cpf" class="input-label">CPF</label>
                        <input type="text" id="cpf" name="cpf" placeholder="CPF" required maxlength="12">
                    </div>
                    <div class="half-width">
                        <label for="bairro" class="input-label">Bairro</label>
                        <input type="text" id="bairro" name="bairro" placeholder="Bairro" required>
                    </div>
                    <div class="half-width">
                        <label for="data_de_nascimento" class="input-label">Data de Nascimento</label>
                        <input type="date" id="data_de_nascimento" name="data_de_nascimento" required>
                    </div>
                    <div class="half-width">
                        <label for="cidade" class="input-label">Cidade</label>
                        <input type="text" id="cidade" name="cidade" placeholder="Cidade" required>
                    </div>
                    <div class="half-width">
                        <label for="sexo" class="checkbox-label">Sexo</label>
                        <div class="gender-container">
                            <div class="checkbox-group">
                                <input type="checkbox" id="generoM" name="genero" value="M">
                                <label for="generoM">M</label>
                            </div>
                            <div class="checkbox-group" style="margin-left: 30px;">
                                <input type="checkbox" id="generoF" name="genero" value="F">
                                <label for="generoF">F</label>
                            </div>
                        </div>
                    </div>
                    <div class="half-width">
                        <label for="estado" class="input-label">Estado</label>
                        <input type="text" id="estado" name="estado" placeholder="Estado" maxlength="2" required>
                    </div>
                    <div class="full-width">
                        <button type="submit" name="signUp">Criar Conta</button>
                    </div>
                </form>
                <div class="account-check-container">
                    <p>Já possui uma conta? <a href="/login">Entrar</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="public/js/user/signUpUser.js"></script>
</body>

</html>