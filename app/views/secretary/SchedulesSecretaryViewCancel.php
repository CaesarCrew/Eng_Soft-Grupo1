<body>
    <nav>
        <a href="/homeSecretaria" class="home-link">Home</a>
    </nav>
    <div class="contauner">
        <h1>Agendamentos</h1>
        <table>
            <tr>
                <th>ID Consulta</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Criado Por</th>
                <th>Ação</th>
            </tr>
            <?php if (!empty($appointments)) : ?>
                <?php foreach ($appointments as $appointment) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($appointment['id']); ?></td>
                        <td><?php echo htmlspecialchars(date('d/m/Y', strtotime($appointment['data']))); ?></td>
                        <td><?php echo htmlspecialchars($appointment['hora']); ?></td>
                        <td><?php echo htmlspecialchars($appointment['tipo_criador']); ?></td>
                        <td class="button-container">
                            <button type="button" class="button" onclick="confirmCancellation(<?php echo htmlspecialchars($appointment['id']); ?>)">Cancelar</button>
                            <form id="cancel-form-<?php echo htmlspecialchars($appointment['id']); ?>" method="POST" action="/cancelarHorario" style="display: none;">
                                <input type="hidden" name="id_consulta" value="<?php echo htmlspecialchars($appointment['id']); ?>">
                            </form>
                            <form method="GET" action="/visualizarAgendamentos/informacoes">
                                <input type="hidden" name="id_consulta" value="<?php echo htmlspecialchars($appointment['id']); ?>">
                                <button type="submit" class="info-button">Ver Informações</button>
                            </form>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">Nenhum agendamento encontrado</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
    <script src="public/js/secretary/SchedulesSecretaryCancel.js"></script>
</body>

</html>