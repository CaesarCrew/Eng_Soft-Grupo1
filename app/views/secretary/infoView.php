<body>
    <div class="header">
        <a href="/homeSecretaria">HealthConnect</a>
    </div>
    <form method="POST" action="/logoutSecretary" class="logout">
        <button type="submit" class="logout-button">Logout</button>
    </form>
    <div class="container">
        <h2 class="title">Informações do Paciente</h2>

        <?php if (!empty($patient) && is_array($patient[0])): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <td><?php echo isset($patient[0]['id']) ? htmlspecialchars($patient[0]['id']) : 'N/A'; ?></td>
                </tr>
                <tr>
                    <th>Nome</th>
                    <td><?php echo isset($patient[0]['Nome']) ? htmlspecialchars($patient[0]['Nome']) : 'N/A'; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo isset($patient[0]['email']) ? htmlspecialchars($patient[0]['email']) : 'N/A'; ?></td>
                </tr>
                <tr>
                    <th>Telefone</th>
                    <td><?php echo isset($patient[0]['telefone']) ? htmlspecialchars($patient[0]['telefone']) : 'N/A'; ?></td>
                </tr>
                <tr>
                    <th>CPF</th>
                    <td><?php echo isset($patient[0]['cpf']) ? htmlspecialchars($patient[0]['cpf']) : 'N/A'; ?></td>
                </tr>
                <tr>
                    <th>Gênero</th>
                    <td><?php echo isset($patient[0]['genero']) ? htmlspecialchars($patient[0]['genero']) : 'N/A'; ?></td>
                </tr>
                <tr>
                    <th>Data de Nascimento</th>
                    <td><?php echo isset($patient[0]['data_de_nascimento']) ? htmlspecialchars($patient[0]['data_de_nascimento']) : 'N/A'; ?></td>
                </tr>
                <tr>
                    <th>Status da Consulta</th>
                    <td><?php echo isset($status) ? htmlspecialchars($status) : 'N/A'; ?></td>
                </tr>
                <tr>
                    <th>Alterar Status Para</th>
                    <td>
                        <input type="hidden" id="id_consulta" value="<?php echo htmlspecialchars($_GET['id_consulta']); ?>">
                        <div class="info-button-container">
                            <button type="button" name="status" value="concluida" class="info-button">Consulta Concluída</button>
                            <button type="button" name="status" value="nao_compareceu" class="info-button">Não Compareceu</button>
                            <button type="button" name="status" value="pendente" class="info-button">Pendente</button>
                        </div>
                    </td>
                </tr>
            </table>
        <?php else: ?>
            <p>Informações do paciente não encontradas.</p>
        <?php endif; ?>

        <div class="button-container">
            <a class="login-button" href="/visualizarAgendamentos">Voltar para a lista de agendamentos</a>
        </div>
    </div>

    <script src="/public/js/secretary/info.js"></script>
</body>
</html>
