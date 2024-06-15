<body>
    <div class="header">
        <a href="#">HealthConnect</a>
    </div>
    <div class="container">
        <h1 class="title">Painel Secretaria</h1>
        <form>
            <button type="button" class="login-button" onclick="window.location.href='http://localhost/horarios'">Cadastrar Horário</button>
            <button type="button" class="login-button" onclick="window.location.href='http://localhost/agendarHorarios'">Agendar Consulta</button>
            <button type="button" class="login-button" onclick="window.location.href='http://localhost/visualizarAgendamentos'">Visualizar Agendamentos</button>
            <button type="button" class="login-button" onclick="window.open('http://localhost/cadastro', '_blank')">Cadastrar Paciente</button>
        </form>
    </div>
    <form method="POST" action="/logoutSecretary" class="logout">
        <button type="submit" class="logout-button">Logout</button>
    </form>
</body>
</html>
