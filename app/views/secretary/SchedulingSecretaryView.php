<form method="POST" action="/agenda">
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
 
<table >
    <thead>
            <tr>
                <th>dia da semana</th>
                <th>data</th>
                <th>hora</th>
            </tr>
    </thead>
    <tbody>
        
        <?php foreach($dados as $dado) { ?> 
            <tr>
                <td><?php echo  $dado["dia_da_semana"] ;?></td>
                <td><?php echo $dado["data"] ;?></td>
                <td><?php echo $dado["hora"] ;?></td>
            </tr>
        <?php } ?>
    </tbody>
    
</table>

<a href="?pagina=1">Primeira</a>
<?php if($page>1){ ?>
<a href="?pagina=<?=$page-1 ?>"><<<</a>
<?php }?>

<?php echo $page; ?>

<?php if($page<$pages){?>
<a href="?pagina=<?=$page+1?>">>>></a>
<?php }?>
<a href="?pagina=<?=$pages?>">Ultima</a>