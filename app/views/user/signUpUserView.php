<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: flex-end; /* Alinha o conteúdo à direita */
            align-items: center; /* Centraliza verticalmente */
            height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .form_container {
            background-color: #fff;
            padding: 20px;
            width: 100%;
            max-width: 600px; /* Limita a largura do formulário */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-right: 20px; /* Margem direita para afastar do lado direito */
        }

        form {
            display: flex;
            flex-wrap: wrap; /* Permite que os campos quebrem para a próxima linha */
            gap: 15px; /* Espaçamento entre os campos */
        }

        .form-column {
            flex: 1; /* Ocupa todo o espaço disponível */
            display: flex;
            flex-direction: column;
        }

        .form-column label {
            margin-bottom: 8px;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="date"],
        input[type="checkbox"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            flex: 1; /* Ocupa todo o espaço disponível na largura */
        }

        .gender-container {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 10px;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Responsividade */
        @media (max-width: 600px) {
            body {
                justify-content: center; /* Centraliza o conteúdo em telas menores */
            }

            .form_container {
                width: 100%;
                margin-right: 0; /* Remove a margem direita em telas menores */
            }
        }
    </style>
</head>
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
    <div class="form_container">
        <form id="signupForm" method="POST">
            <div class="form-row">
                <div class="form-column">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-column">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-column">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-column">
                    <label for="telefone">Telefone</label>
                    <input type="text" id="telefone" name="telefone" maxlength="12" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-column">
                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" maxlength="12" required>
                </div>
                <div class="form-column">
                    <label for="sexo">Sexo:</label>
                    <div class="gender-container">
                        <label for="generoM">M</label>
                        <input type="checkbox" id="generoM" name="genero" value="M">
                        <label for="generoF">F</label>
                        <input type="checkbox" id="generoF" name="genero" value="F">
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-column">
                    <label for="data_de_nascimento">Data de Nascimento</label>
                    <input type="date" id="data_de_nascimento" name="data_de_nascimento" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-column">
                    <label for="cep">CEP</label>
                    <input type="text" id="cep" name="cep" maxlength="8" required>
                </div>
                <div class="form-column">
                    <label for="logradouro">Logradouro</label>
                    <input type="text" id="logradouro" name="logradouro" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-column">
                    <label for="numero">Número</label>
                    <input type="text" id="numero" name="numero" required>
                </div>
                <div class="form-column">
                    <label for="complemento">Complemento</label>
                    <input type="text" id="complemento" name="complemento">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-column">
                    <label for="bairro">Bairro</label>
                    <input type="text" id="bairro" name="bairro" required>
                </div>
                <div class="form-column">
                    <label for="cidade">Cidade</label>
                    <input type="text" id="cidade" name="cidade" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-column">
                    <label for="estado">Estado</label>
                    <input type="text" id="estado" name="estado" maxlength="2" required>
                </div>
            </div>
            <button type="submit" name="signUp">Enviar</button>
        </form>
        <p>Já tem uma conta? <a href="/login">Log in</a></p>
    </div>

    <script src="public/js/user/signUpUser.js"></script>
</body>
</html>
