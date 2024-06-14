<style>
body {
    margin: 0;
    height: 100vh; /* 100% da altura da viewport */
    background-image: url('../public/css/secretary/BackgroundFull.png');
    background-size: cover; /* Cobrir toda a área do body */
    background-position: center; /* Centralizar a imagem */
    font-family: 'Poppins', sans-serif; /* Exemplo de fonte para o texto */
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative; /* Necessário para posicionar o header */
}

.container {
    border-radius: 16px; /* Reduzido para um design mais compacto */
    background-color: var(--background-mode, #fff);
    width: 400px; /* Reduzido para um tamanho mais compacto */
    max-width: 100%;
    padding: 32px 48px 48px; /* Reduzido o padding para diminuir o espaço interno */
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Exemplo de sombra para destacar o container */
    text-align: center;
    position: relative; /* Necessário para o espaçador */
    margin-top: 100px; /* Ajuste conforme necessário */
}

.title {
    color: var(--foreground-high, #101828);
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 24px;
}

.user-options {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.login-button {
    background-color: var(--container-primary, #1570ef);
    color: var(--foreground-onColor, #fcfcfd);
    font-weight: 600;
    border: none;
    border-radius: 5px;
    padding: 16px 0;
    width: 100%;
    font-size: 18px;
    cursor: pointer;
    text-decoration: none;
}

.login-button:hover {
    background-color: #125bb2; /* Cor mais escura ao passar o mouse */
}

.header {
    position: absolute;
    top: 30px;
    left: 34px;
    font-size: 1.9rem;
    font-weight: bold;
    font-family: 'Poppins', sans-serif;
}

.header a {
    text-decoration: none;
    color: white;
}

</style>
<body>
    <div class="header">
        <a href="#">HealthConnect</a>
    </div>
    <div class="container">
        <h1 class="title">Painel Principal</h1>
        <div class="user-options">
            <a href="http://localhost/loginSecretaria" class="login-button">Login Secretaria</a>
            <a href="http://localhost/login" class="login-button">Login Usuário</a>
            <a href="http://localhost/cadastro" class="login-button">Cadastro Usuário</a>
        </div>
    </div>
</body>
</html>
