<?php
// Número de agendamentos por página
$appointments_per_page = 7;

// Obter o número da página atual
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);

// Calcular o índice inicial e final para a página atual
$start_index = ($page - 1) * $appointments_per_page;
$end_index = min($start_index + $appointments_per_page, count($appointments));

// Filtrar os agendamentos para a página atual
$current_appointments = array_slice($appointments, $start_index, $appointments_per_page);

// Calcular o número total de páginas
$total_pages = ceil(count($appointments) / $appointments_per_page);
?>

<header>
    <a href="/home" class="home-link">HealthConnect</a>
    <form method="POST" action="/logout" class="logout">
        <button type="submit" class="logout-button">Logout</button>
    </form>
</header>

<body>
    <div class="container">
        <h1>Meus Agendamentos</h1>

        <table class="schedule-table">
            <thead>
                <tr>
                    <th>ID Consulta</th>
                    <th>Data</th>
                    <th>Hora</th>
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
                            <td><?php echo htmlspecialchars($appointment['status'] ?? 'pendente'); ?></td>
                            <td class="button-container">
                                <button type="button" class="cancel-button" onclick="cancelAppointment(<?php echo htmlspecialchars($appointment['id']); ?>)">Cancelar</button>
                                <form id="cancel-form-<?php echo htmlspecialchars($appointment['id']); ?>" method="POST" action="/cancelarConsultaUsuario" style="display: none;">
                                    <input type="hidden" name="id_consulta" value="<?php echo htmlspecialchars($appointment['id']); ?>">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4">Nenhum agendamento encontrado</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php if ($page > 1) : ?>
                <a href="?page=<?php echo $page - 1; ?>" class="previous">&laquo; Anterior</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                <a href="?page=<?php echo $i; ?>" class="page-number <?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>

            <?php if ($page < $total_pages) : ?>
                <a href="?page=<?php echo $page + 1; ?>" class="next">Próximo &raquo;</a>
            <?php endif; ?>
        </div>
    </div>
    <script src="public/js/user/ScheduleTimeUserCancel.js"></script>
</body>

</html>