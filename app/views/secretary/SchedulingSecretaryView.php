<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Horários</title>
    <style>
        
    </style>
</head>
<body>

<h1 onclick="window.location.href='/homeSecretaria'">Home</h1>

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



<div class="container">
    <table id= "tabela-horarios">
        <thead>
            <tr>
                <th>Dia da Semana</th>
                <th>Data</th>
                <th>Hora</th>
                <th colspan="3">Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($dados as $dado) { ?>
                <tr >
                <td><?php echo  $dado["dia_da_semana"] ;?></td>
                <form method="PUT" >

                    <td>
                        
                        <span id="data-<?php echo $dado["id"]; ?>"><?php echo $dado["data"]; ?></span>
                        <input name = "data" type="date" id="edit-data-<?php echo $dado["id"]; ?>" value="<?php echo date("Y-m-d", strtotime(str_replace("-", "/", $dado["data"]))); ?>" style="display: none;">
                    </td>
                    <td>
                        <span id="hora-<?php echo $dado["id"]; ?>"><?php echo substr($dado["hora"], 0, 5); ?></span>
                        <input name = "hora" type="time" id="edit-hora-<?php echo $dado["id"]; ?>" value="<?php echo substr($dado["hora"], 0, 5); ?>" style="display: none;">
                    </td>
                    <td>
                        <button type="button" id="enviar-<?php echo $dado["id"]; ?>" onclick="putHorario( <?php echo $dado['id']; ?>)" style="display: none;">Confirmar</button>
                    </td>
                </form>
                    <td>
                        <button onclick="toggleEdit(<?php echo $dado['id']; ?>)">Editar</button>
                    </td>
                    <td>
                        <form method="DELETE">
                            <button type="button" onclick="deleteHorario( <?php echo $dado['id']; ?>)">Deletar</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="pagination">
        <a href="?pagina=1">Primeira</a>
        <?php if($page > 1): ?>
            <a href="?pagina=<?=$page - 1 ?>"><<<</a>
        <?php endif; ?>
        <?php echo $page; ?>
        <?php if($page < $pages): ?>
            <a href="?pagina=<?=$page + 1 ?>">>>></a>
        <?php endif; ?>
        <a href="?pagina=<?=$pages ?>">Última</a>
    </div>
</div>






<script src="public/js/secretary/SchedulingSecretary.js"></script>

</body>
</html>
