<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
     
    </style>
</head>
<body>
<a href="/home" class="home-link">HOME</a>
<div class="form_container">
    <form id="signupForm" method="POST" >
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


<script src="public/js/user/signUpUser.js"></script>