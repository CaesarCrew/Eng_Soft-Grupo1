<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: rgb(164, 70, 238);
            position: relative;
        }
        .container {
            text-align: center;
        }
        .form_login {
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 0 auto;
            position: relative;
        }
        .form_login label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .form_login input[type="email"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form_login button[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #0056b3;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        a.home-link {
            position: absolute;
            top: 20px;
            left: 20px;
            cursor: pointer;
            color: white;
            text-decoration: none; /* Removendo sublinhado do link */
            font-size: 18px; /* Ajustando o tamanho da fonte */
        }
    </style>
</head>
<body>
<a href="/home" class="home-link">HOME</a>
<div class="container">
    <h1>Redefinir Senha</h1>
    <div class="form_login">
        <form method="POST" action="/sendMailPassword">
            <label for="email">Seu Email:</label>
            <input type="email" id="email" name="email" required><br>
            <button type="submit" name="resetPassword">Redefinir Senha</button>
        </form>
    </div>
</div>

</body>
</html>
