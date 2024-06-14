<body>
    <div class="header">
        <a href="#">HealthConnect</a>
    </div>
    <div class="container">
        <h1 class="title">Painel Usuário</h1>
        <form>
            <button type="button" onclick="location.href='http://localhost/agendarHorariosPaciente'" class="login-button">Agendar Consulta</button>
            <button type="button" onclick="location.href='http://localhost/visualizarAgendamentosUsuario'" class="login-button">Visualizar Agendamentos</button>
        </form>
    </div>
    <form method="POST" action="/logout" class="logout">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
