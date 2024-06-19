<body>

    <header>
        <a href="/homeSecretaria" class="home-link">HealthConnect</a>
    </header>

    <div class="container">
        <form id="form-horarios" method="POST" action="/horarios" onsubmit="AddHorario(event)">
            <label for="data">Data:</label>
            <input type="date" id="data" name="data" required>

            <label for="times[]">Hora:</label>
            <select name="times[]" multiple id="timesSelect">
                <?php
                $start = strtotime('08:00');
                $end = strtotime('18:00');
                $interval = 15 * 60; // 15 minutos em segundos

                for ($i = $start; $i <= $end; $i += $interval) {
                    $time = date('H:i', $i);
                    echo "<option value='$time'>$time</option>";
                }
                ?>
            </select>

            <button type="submit">Adicionar Horário</button>
        </form>

        <table id="tabela-horarios">
            <thead>
                <tr>
                    <th>Dia da Semana</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dados as $dado) { ?>
                    <tr>
                        <td><?php echo $dado["dia_da_semana"]; ?></td>
                        <td>
                            <span id="data-<?php echo $dado["id"]; ?>"><?php echo $dado["data"]; ?></span>
                            <input name="data" type="date" id="edit-data-<?php echo $dado["id"]; ?>" value="<?php echo date("Y-m-d", strtotime(str_replace("-", "/", $dado["data"]))); ?>" style="display: none;">
                        </td>
                        <td>
                            <span id="hora-<?php echo $dado["id"]; ?>"><?php echo substr($dado["hora"], 0, 5); ?></span>
                            <input name="hora" type="time" id="edit-hora-<?php echo $dado["id"]; ?>" value="<?php echo substr($dado["hora"], 0, 5); ?>" style="display: none;">
                        </td>
                        <td class="action-buttons">
                            <button onclick="toggleEdit(<?php echo $dado['id']; ?>)">Editar</button>
                            <button type="button" onclick="deleteHorario(<?php echo $dado['id']; ?>)">Deletar</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="pagination">
            <a href="?pagina=1">Primeira</a>
            <?php if ($page > 1) : ?>
                <a href="?pagina=<?= $page - 1 ?>">
                    <<<< /a>
                    <?php endif; ?>
                    <?= $page; ?>
                    <?php if ($page < $pages) : ?>
                        <a href="?pagina=<?= $page + 1 ?>">>>></a>
                    <?php endif; ?>
                    <a href="?pagina=<?= $pages ?>">Última</a>
        </div>
    </div>


    <script src="public/js/secretary/SchedulingSecretary.js"></script>

</body>

</html>