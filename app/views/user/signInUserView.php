<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>"/>
        <title>LOGIN</title>
    </head>
    <body>
        <h1 class="title"> HOME </h1>
            <div class="form_login">
                <form method="POST">
                    <h2 class="form_label">Login Paciente:</h2>
                    <div>
                    <label for="usuario">E-mail:</label>
                    <input type="text" id="usuario" name="usuario" placeholder="example.email@mail.com" required maxlength="256"><br>
                    </div>
                    <div>
                    <label for="senha"> Senha:</label>
                    <input type="password" id="senha" name="senha" required/>
                    </div>
                    <input type="submit" name="submit" value="Enviar">
                </form>
            </div>
            <div class="sla">
                <a href="http://localhost/cadastro" class="button_senha">Não possui uma conta? Faça cadastro</a>
            </div>
            <a href="http://localhost/loginSecretaria" class="button_sec"> Você é secretária? Faça Login aqui</a>
    </body>
</html>
