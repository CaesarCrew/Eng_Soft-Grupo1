<body>
    <div class="header">
        <a href="/homeSecretaria" class="home-link">HealthConnect</a>
    </div>

    <div class="container">
        <h1>Agendamentos</h1>

        <table class="schedule-table">
            <thead>
                <tr>
                    <th>ID Consulta</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Criado Por</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($appointments)) : ?>
                    <?php foreach ($appointments as $appointment) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($appointment['id']); ?></td>
                            <td><?php echo htmlspecialchars(date('d/m/Y', strtotime($appointment['data']))); ?></td>
                            <td><?php echo htmlspecialchars($appointment['hora']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['tipo_criador']); ?></td>
                            <td><?php switch ($appointment['status_consulta']) {
                                case 0:
                                    echo "Pendente";
                                break;
                                case 1:
                                    echo "Realizada";
                                break;
                                case 2:
                                    echo "Não compareceu";
                                break;
                                default:
                                    echo "Status desconhecido";
                                break;}?></td>
                            <td class="button-container">
                                <button type="button" class="cancel-button" onclick="confirmCancellation(<?php echo htmlspecialchars($appointment['id']); ?>)">Cancelar</button>
                                <form id="cancel-form-<?php echo htmlspecialchars($appointment['id']); ?>" method="POST" action="/cancelarHorario" style="display: none;">
                                    <input type="hidden" name="id_consulta" value="<?php echo htmlspecialchars($appointment['id']); ?>">
                                </form>
                                <?php if (/* Condição para mostrar o botão de informações */ true) : ?>
                                <form method="GET" action="/visualizarAgendamentos/informacoes">
                                    <input type="hidden" name="id_consulta" value="<?php echo htmlspecialchars($appointment['id']); ?>">
                                    <button type="submit" class="info-button">Ver Informações</button>
                                </form>
                                <?php endif; ?>
                                <form class="update-form" id="status-form-<?php echo htmlspecialchars($appointment['id']); ?>" method="POST" action="/alterarStatus">
                                    <input type="hidden" name="id_consulta" value="<?php echo htmlspecialchars($appointment['id']); ?>">
                                    <select class="select-status" name="novo_status" required>
                                        <option value="0" <?php echo $appointment['status_consulta'] == 0 ? 'selected' : ''; ?>>Pendente</option>
                                        <option value="1" <?php echo $appointment['status_consulta'] == 1 ? 'selected' : ''; ?>>Realizada</option>
                                        <option value="2" <?php echo $appointment['status_consulta'] == 2 ? 'selected' : ''; ?>>Não compareceu</option>
                                    </select>
                                    <button type="button" class="update-button" onclick="submitStatusForm(<?php echo htmlspecialchars($appointment['id']); ?>)">Alterar Status</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5">Nenhum agendamento encontrado</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <form method="POST" action="/logoutSecretary" class="logout">
        <button type="submit" class="logout-button">Logout</button>
    </form>

    <script src="public/js/secretary/SchedulesSecretaryCancel.js"></script>
</body>
</html>
