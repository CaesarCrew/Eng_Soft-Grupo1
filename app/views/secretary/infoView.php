<body>
    

    <h2>Informações do Paciente</h2>
    <?php if (!empty($patient)): ?>

    <table>
        <tr>
            <th>ID</th>
            <td><?php echo isset($patient['id']) ? htmlspecialchars($patient['id']) : 'N/A'; ?></td>
        </tr>
        <tr>
            <th>Nome</th>
            <td><?php echo isset($patient['Nome']) ? htmlspecialchars($patient['Nome']) : 'N/A'; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo isset($patient['email']) ? htmlspecialchars($patient['email']) : 'N/A'; ?></td>
        </tr>
        <tr>
            <th>Telefone</th>
            <td><?php echo isset($patient['telefone']) ? htmlspecialchars($patient['telefone']) : 'N/A'; ?></td>
        </tr>
        <tr>
            <th>CPF</th>
            <td><?php echo isset($patient['cpf']) ? htmlspecialchars($patient['cpf']) : 'N/A'; ?></td>
        </tr>
        <tr>
            <th>Gênero</th>
            <td><?php echo isset($patient['genero']) ? htmlspecialchars($patient['genero']) : 'N/A'; ?></td>
        </tr>
        <tr>
            <th>Data de Nascimento</th>
            <td><?php echo isset($patient['data_de_nascimento']) ? htmlspecialchars($patient['data_de_nascimento']) : 'N/A'; ?></td>
        </tr>
    </table>

    <?php endif; ?>

    <a href="/visualizarAgendamentos">Voltar para a lista de agendamentos</a>

</body>
</html>
