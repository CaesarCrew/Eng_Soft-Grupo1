

<form method="POST" action="/horarios">
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
                <form method="POST" action="/horarios/put_id/<?php echo $dado["id"]?>">

                    <td>
                        
                        <span id="data-<?php echo $dado["id"]; ?>"><?php echo $dado["data"]; ?></span>
                        <input name = "data" type="date" id="edit-data-<?php echo $dado["id"]; ?>" value="<?php echo date("Y-m-d", strtotime(str_replace("-", "/", $dado["data"]))); ?>" style="display: none;">
                    </td>
                    <td>
                        <span id="hora-<?php echo $dado["id"]; ?>"><?php echo substr($dado["hora"], 0, 5); ?></span>
                        <input name = "hora" type="time" id="edit-hora-<?php echo $dado["id"]; ?>" value="<?php echo substr($dado["hora"], 0, 5); ?>" style="display: none;">
                    </td>
                    <td>
                        <button type="submit" id="enviar-<?php echo $dado["id"]; ?>" style="display: none;">Confirmar</button>
                    </td>
                </form>
                    <td>
                            <button onclick="toggleEdit(<?php echo $dado['id']; ?>)">Editar</button>
                    </td>
                    <td>
                        <form method="POST" action="/horarios/delete_id/<?php echo $dado["id"]?>">
                            <input type="hidden" name="id" value=<?php echo $dado["id"] ;?>>
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                    
                <td>
</td>

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

<script>
    function toggleEdit(id) {
        const editData = document.getElementById('edit-data-' + id);
        const editHora = document.getElementById('edit-hora-' + id);
        const spanData = document.getElementById('data-' + id);
        const spanHora = document.getElementById('hora-' + id);
        const enviarHora = document.getElementById('enviar-' + id);

        if (editData.style.display === 'none') {
            editData.style.display = 'inline';
            editHora.style.display = 'inline';
            enviarHora.style.display = 'inline';
            spanData.style.display = 'none';
            spanHora.style.display = 'none';
        } else {
            editData.style.display = 'none';
            editHora.style.display = 'none';
            enviarHora.style.display = 'none';
            spanData.style.display = 'inline';
            spanHora.style.display = 'inline';
        }
    }
</script>