<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #A446EE;
            overflow: auto;
            position: relative; /* Adicionando position relative para o body */
        }
        .form_container {
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            margin: 20px;
            box-sizing: border-box;
            overflow-y: auto;
            max-height: 90vh;
        }
        .form_container label {
            margin-top: 10px;
            font-weight: bold;
            display: block;
        }
        .form_container input[type="text"],
        .form_container input[type="password"],
        .form_container input[type="email"],
        .form_container input[type="date"],
        .form_container input[type="number"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form_container input[type="checkbox"] {
            margin-right: 10px;
        }
        .form_container .gender-container {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }
        .form_container .gender-container label {
            margin-right: 5px;
            margin-left: 15px;
        }
        .form_container button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            border: none;
            border-radius: 4px;
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-sizing: border-box;
        }
        .form_container button:hover {
            background-color: #0056b3;
        }
        a.home-link {
            position: absolute; /* Alterando para posição absoluta */
            top: 20px;
            left: 20px; /* Ajustando para o canto superior esquerdo */
            cursor: pointer;
            color: white; /* Adicionando cor branca para melhor visibilidade */
            text-decoration: none; /* Removendo sublinhado do link */
            font-size: 18px; /* Ajustando o tamanho da fonte */
        }
    </style>
</head>
<body>
<a href="/home" class="home-link">HOME</a>
<div class="form_container">
    <form method="POST" action="/cadastro">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required>
        
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" required>

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" required>
        
        <label for="telefone">Telefone</label>
        <input type="text" id="telefone" name="telefone" required maxlength="12">
        
        <label for="cpf">CPF</label>
        <input type="text" id="cpf" name="cpf" required maxlength="12">
        
        <label for="sexo">Sexo:</label>
        <div class="gender-container">
            <label for="generoM">M</label>
            <input type="checkbox" id="generoM" name="genero" value="M">
            <label for="generoF">F</label>
            <input type="checkbox" id="generoF" name="genero" value="F">
        </div>

        <label for="data_de_nascimento">Data de Nascimento</label>
        <input type="date" id="data_de_nascimento" name="data_de_nascimento" required>
        
        <label for="cep">CEP</label>
    <input type="text" id="cep" name="cep" maxlength="8" required>

    <label for="logradouro">Logradouro</label>
    <input type="text" id="logradouro" name="logradouro" required>

    <label for="numero">Número</label>
    <input type="text" id="numero" name="numero" required>

    <label for="complemento">Complemento</label>
    <input type="text" id="complemento" name="complemento">

    <label for="bairro">Bairro</label>
    <input type="text" id="bairro" name="bairro" required>

    <label for="cidade">Cidade</label>
    <input type="text" id="cidade" name="cidade" required>

    <label for="estado">Estado</label>
    <input type="text" id="estado" name="estado" maxlength="2" required>

    <button type="submit" name="signUp">Enviar</button>
</form>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("generoM").addEventListener("click", function() {
            genero('m');
        });

        document.getElementById("generoF").addEventListener("click", function() {
            genero('f');
        });
    });

    function genero(sexo) {
        
        let selecM = document.getElementById("generoM");
        let selecF = document.getElementById("generoF");
        if (sexo === 'm') {
            selecM.checked = true;
            selecF.checked = false;
        } else if (sexo === 'f') {
            selecF.checked = true;
            selecM.checked = false;
        }
    }
</script>