<body>
    <div class="header">
        <a href="/home" class="home-link">HealthConnect</a>
    </div>

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
            <button type="submit" class="select-button">Enviar</button>
        </form>
    </div>

    <form method="POST" action="/logout" class="logout">
        <button type="submit">Logout</button>
    </form>

    <script src="public/js/user/ScheduleTime.js"></script>
</body>
</html>
