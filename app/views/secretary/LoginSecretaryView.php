<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Secretaria</title>
    <link rel="stylesheet" href="CSS\styles.css?v=<?php echo time();?>"/>
    <link rel="stylesheet" href="CSS\LoginSecretary.css?v=<?php echo time();?>"/>
</head>
<body>
<h1 class="title"> LOGIN </h1>
    <div class="form_login">
        <form method="POST" action="/loginSecretaria">
            <h2 class="form_label">Usuário:</h2>
            <div class="usuario_input">
                <label class="input_label" for="usuario">Usuário:</label>
                <input type="text" id="usuario" name="usuario" placeholder="example.email@mail.com" required maxlength="256"><br>
            </div>
            <div class="senha_input">
                <label class="input_label" for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required/>
            </div>
            <input type="submit" name="submit" value="Enviar">
        </form>
</body>
</html>
