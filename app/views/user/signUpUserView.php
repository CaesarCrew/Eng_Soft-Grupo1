<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time();?>"/>
</head>
<body>
<a href="/home" class="home">HOME</a>

<div class="form_login">
    <form method="POST" action="/cadastro">
        <h2 class="form_label">Cadastro de Paciente</h2>
        <label class="label_cadastro" for="nome">Nome</label>
        <div>
            <input type="text" id="nome" name="nome" required>
        </div>
        <label class="label_cadastro" for="senha">Senha</label>
        <div>
            <input type="password" id="senha" name="senha" required>
        </div>

        <label class="label_cadastro" for="email">E-mail</label>
        <div>
            <input type="email" id="email" name="email" required>
        </div>

        <label class="label_cadastro" for="telefone">Telefone</label>
        <div>
            <input type="text" id="telefone" name="telefone" required maxlength="12">
        </div>

        <label class="label_cadastro" for="cpf">CPF</label>
        <div>
            <input type="text" id="cpf" name="cpf" required maxlength="12">
        </div>
        <div class="input_label">
            <label class="sexo" for="sexo">Sexo</label>
            <label class="labels_cad" for="data_de_nascimento">Data de Nascimento</label>
        </div>

        <div class="gender">
            <div>
            <label for="generoM">M</label>
            <input type="checkbox" id="generoM" name="genero" value="M">
            <label for="generoF">F</label>
            <input type="checkbox" id="generoF" name="genero" value="F">
            </div>
            <div class="data">
            <input type="date" id="data_de_nascimento" name="data_de_nascimento" required>
            </div>
        </div>

        <label class="label_cadastro" for="logradouro">Logradouro</label>
        <div>
        <input type="text" id="logradouro" name="logradouro" required>
        </div>

        <label class="label_cadastro" for="numero">Número</label>
        <div>
        <input type="text" id="numero" name="numero" required>
        </div>

        <label class="label_cadastro" for="complemento">Complemento</label>
        <div>
        <input type="text" id="complemento" name="complemento">
        </div>

        <label class="label_cadastro" for="bairro">Bairro</label>
        <div>
        <input type="text" id="bairro" name="bairro" required>
        </div>

        <label class="label_cadastro" for="cidade">Cidade</label>
        <div>
        <input type="text" id="cidade" name="cidade" required>
        </div>

        <div class="input_label">
            <label class="cep" for="cep">CEP</label>
            <label class="labels_cads" for="estado">Estado</label>
        </div>
        <div class="gender">
            <div>
                <input type="text" id="cep" name="cep" maxlength="8" required>
            </div>
            <div class="estado">
                <input type="text" id="estado" name="estado" maxlength="2" required>
            </div>
        </div>

        <input type="submit" name="signUp" value="Enviar">
    </form>
</div>


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