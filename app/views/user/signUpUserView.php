<body>
    <div class="container">
        <div class="container__apresentacao">
            <img src="public/css/user/BackgroundMedium.png" alt="BackgroundMedium" class="container__apresentacao__background">
            <div class="header">
            <a href="/home" class="home-link">HealthConnect</a>
            </div>
            <h1 class="apresentacao">Bem-vindo. <br> Comece sua jornada agora com nosso sistema de gestão!</h1>
        </div>

        <div class="container__registro">
            <div class="form__titulo">
                <h1>Cadastrar</h1>
            </div>
            <div class="container__registro__form">
                <form class="form">
                    <div class="container__registro__esquerda">
                        <div class="campo">
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" placeholder="Nome">
                        </div>
                        <div class="campo">
                            <label for="senha">Senha</label>
                            <input type="password" id="senha" placeholder="Senha">
                        </div>
                        <div class="campo">
                            <label for="email">Email</label>
                            <input type="email" id="email" placeholder="Email">
                        </div>
                        <div class="campo">
                            <label for="telefone">Telefone</label>
                            <input type="text" id="telefone" placeholder="Telefone">
                        </div>
                        <div class="campo">
                            <label for="cpf">CPF</label>
                            <input type="text" id="cpf" placeholder="CPF">
                        </div>
                        <div class="campo">
                            <label for="data_nascimento">Data de Nascimento</label>
                            <input type="date" id="data_nascimento">
                        </div>
                        <div class="campo">
                            <label>Sexo</label>
                            <div class="checkboxes">
                                <label><input type="checkbox" name="sexo" value="masculino"> Masculino</label>
                                <label><input type="checkbox" name="sexo" value="feminino"> Feminino</label>
                            </div>
                        </div>
                    </div>
                    <div class="container__registro__direita">
                        <div class="campo">
                            <label for="cep">CEP</label>
                            <input type="text" id="cep" placeholder="CEP">
                        </div>
                        <div class="campo">
                            <label for="logradouro">Logradouro</label>
                            <input type="text" id="logradouro" placeholder="Logradouro">
                        </div>
                        <div class="campo">
                            <label for="numero">Número</label>
                            <input type="text" id="numero" placeholder="Número">
                        </div>
                        <div class="campo">
                            <label for="complemento">Complemento</label>
                            <input type="text" id="complemento" placeholder="Complemento">
                        </div>
                        <div class="campo">
                            <label for="bairro">Bairro</label>
                            <input type="text" id="bairro" placeholder="Bairro">
                        </div>
                        <div class="campo">
                            <label for="cidade">Cidade</label>
                            <input type="text" id="cidade" placeholder="Cidade">
                        </div>
                        <div class="campo">
                            <label for="estado">Estado</label>
                            <input type="text" id="estado" placeholder="Estado">
                        </div>
                    </div>
                </form>
                <div class="form__botoes">
                    <button type="submit">Criar Conta</button>
                    <p>Já tem uma conta? <a href="#">Log in</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="public/js/user/signUpUser.js"></script>
</body>
</html>


