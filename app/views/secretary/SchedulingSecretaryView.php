<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Horários</title>
    <link rel="stylesheet" href="CSS\styles.css?v=<?php echo time();?>"/>
    <link rel="stylesheet" href="CSS\SchedulingSecretary.css?v=<?php echo time();?>"/>
</head>
<body>

<h1 onclick="window.location.href='/homeSecretaria'">Home</h1>

<form id="form-horarios" method="POST" action="/horarios">
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
    <table>
        <thead>
            <tr>
                <th>Dia da Semana</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($dados as $dado) { ?>
                <tr>
                    <td><?php echo $dado["dia_da_semana"]; ?></td>
                    <td><?php echo $dado["data"]; ?></td>
                    <td><?php echo substr($dado["hora"], 0, 5); ?></td>
                    <td>
                        <form method="POST" action="/horarios/edit_id/<?php echo $dado["id"]?>">
                            <input type="hidden" name="id" value="<?php echo $dado["id"]; ?>">
                            <input type="hidden" name="data" value="<?php echo $dado["data"]; ?>">
                            <input type="hidden" name="hora" value="<?php echo $dado["hora"]; ?>">
                            <button type="submit">Editar</button>
                        </form>
                        <form method="POST" action="/horarios/delete_id/<?php echo $dado["id"]?>">
                            
                            <button type="submit" value="<?php echo $dado["id"]; ?>">Deletar</button>
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

</body>
</html>
