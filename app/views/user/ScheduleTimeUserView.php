<?php
// Determinar a página atual
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 7;
$offset = ($page - 1) * $items_per_page;

// Obter o número total de horários disponíveis
$total_items = count($schedules); // Assumindo que $schedules contém todos os horários
$total_pages = ceil($total_items / $items_per_page);

// Buscar apenas os horários para a página atual
$current_page_schedules = array_slice($schedules, $offset, $items_per_page);
?>

<header>
    <a href="/home" class="home-link">HealthConnect</a>
    <form method="POST" action="/logout" class="logout">
        <button type="submit" class="logout-button">Logout</button>
    </form>
</header>

<body>

    <div class="container">
        <h1>Horários Disponíveis</h1>
        <form id="select-form" method="POST" action="/selecionarHorario_paciente">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">

            <table class="schedule-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Dia da Semana</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Disponível</th>
                        <th>Selecionar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($schedules)) {
                        foreach ($schedules as $row) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["dia_da_semana"]) . "</td>";
                            // Convertendo a data para o formato brasileiro
                            $data_formatada = date('d/m/Y', strtotime($row["data"]));
                            echo "<td>" . htmlspecialchars($data_formatada) . "</td>";
                            echo "<td>" . htmlspecialchars($row["hora"]) . "</td>";
                            echo "<td>" . ($row["disponivel"] ? 'Sim' : 'Não') . "</td>";
                            // Checkbox "Selecionar"
                            echo "<td><input type='checkbox' name='selected_schedules[]' value='" . htmlspecialchars($row["id"]) . "'></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Nenhum horário disponível encontrado</td></tr>";
                    }
                    ?>
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
            <button type="submit" class="select-button">Enviar</button>
        </form>
    </div>



    <script src="public/js/user/ScheduleTime.js"></script>
</body>

</html>