<form method="POST" action="/agenda/adicionar-horarios">
    <label for="data">Data:</label>
    <input type="date" id="data" name="data" required><br><br>

    <label for="times[]">Hora:</label>
    <!-- <input type="time" id="time" name="time" required><br><br> -->
    
 


    <select name="times[]"  multiple id="timesSelect">
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

