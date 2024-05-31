<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Secretaria</title>
    <link rel="stylesheet" href="styles.css"/>
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
