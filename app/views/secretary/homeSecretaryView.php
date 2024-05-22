<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Secretaria</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #A446EE;
        }
        .container {
            text-align: center;
            width: 300px;
            padding: 20px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            position: relative;
        }
        .button {
            display: block;
            width: 100%;
            padding: 10px 20px;
            margin-bottom: 15px;
            border: none;
            border-radius: 4px;
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .logout {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 0;
            background: none;
            border: none;
            cursor: pointer;
        }
        .logout button {
            background-color: #d9534f;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .logout button:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>

<div class="container">
    <button class="button" onclick="window.location.href='http://localhost/horarios'">Cadastrar Horário</button>
    <button class="button">Agendar Consulta</button>
    <button class="button">Visualizar Agendamentos</button>
    <button class="button">Cancelar Consulta</button>
</div>

<form method="POST" action="/logoutSecretary" class="logout">
        <button type="submit">Logout</button>
</form>

</body>
</html>
