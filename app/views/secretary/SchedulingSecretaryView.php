<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Horários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #A446EE;
            margin: 0;
            padding: 20px;
            position: relative;
        }
        h1 {
            /*position: absolute;*/
            top: 20px;
            left: 20px;
            cursor: pointer;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        form label {
            display: block;
            margin-bottom: 5px;
        }
        form input[type="date"],
        form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        form button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        form button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        td button {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            background-color: #007BFF;
            color: white;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        td button:hover {
            background-color: #0056b3;
        }
        .pagination {
            margin-top: 20px;
            text-align: center;
        }
        .pagination a {
            display: inline-block;
            padding: 8px 16px;
            text-decoration: none;
            color: #007BFF;
            border: 1px solid #007BFF;
            border-radius: 4px;
            margin-right: 5px;
        }
        .pagination a.active {
            background-color: #007BFF;
            color: white;
        }
    </style>
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
                        <button onclick="toggleEdit(<?php echo $dado['id']; ?>)">Editar</button>
                        <form method="POST" action="/horarios/delete_id/<?php echo $dado["id"]?>">
                            <input type="hidden" name="id" value="<?php echo $dado["id"]; ?>">
                            <button type="submit">Deletar</button>
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

</body>
</html>
