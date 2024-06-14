<body>
    <div class="header">
        <a href="/home" class="home-link">HealthConnect</a>
    </div>

    <div class="container">
        <h1>Meus Agendamentos</h1>

        <table class="schedule-table">
            <thead>
                <tr>
                    <th>ID Consulta</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($appointments)): ?>
                    <?php foreach ($appointments as $appointment): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($appointment['id']); ?></td>
                            <td><?php echo htmlspecialchars(date('d/m/Y', strtotime($appointment['data']))); ?></td>
                            <td><?php echo htmlspecialchars($appointment['hora']); ?></td>
                            <td class="button-container">
                                <button type="button" class="cancel-button" onclick="cancelAppointment(<?php echo htmlspecialchars($appointment['id']); ?>)">Cancelar</button>
                                <form id="cancel-form-<?php echo htmlspecialchars($appointment['id']); ?>" method="POST" action="/cancelarConsultaUsuario" style="display: none;">
                                    <input type="hidden" name="id_consulta" value="<?php echo htmlspecialchars($appointment['id']); ?>">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4">Nenhum agendamento encontrado</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="public/js/user/ScheduleTimeUserCancel.js"></script>
</body>
</html>
