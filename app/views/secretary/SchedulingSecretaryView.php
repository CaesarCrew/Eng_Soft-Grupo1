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






<script>
   
    function toggleEdit(id) {
        const editData = document.getElementById('edit-data-' + id);
        const editHora = document.getElementById('edit-hora-' + id);
        const spanData = document.getElementById('data-' + id);
        const spanHora = document.getElementById('hora-' + id);
        const confirmButton = document.querySelector(`#tabela-horarios #enviar-${id}`);

        editData.style.display = editData.style.display === 'none' ? 'inline' : 'none';
        editHora.style.display = editHora.style.display === 'none' ? 'inline' : 'none';
        spanData.style.display = spanData.style.display === 'none' ? 'inline' : 'none';
        spanHora.style.display = spanHora.style.display === 'none' ? 'inline' : 'none';
        confirmButton.style.display = confirmButton.style.display === 'none' ? 'inline' : 'none';
    }

   




    async function AddHorario(event) {
            event.preventDefault();

            const form = document.getElementById("form-horarios");
            const formData = new FormData(form);
            try{ 
                const response = await fetch("http://localhost/horarios", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        data: formData.get('data'),
                        times: times = formData.getAll('times[]')
                    })
                })
                const text = await response.text();

                const data = JSON.parse(text);
                if (data.status === 'success') {
                    console.log("Horario adicionado")
                    window.location.replace('http://localhost/horarios');
                
                } else {
                    alert('Erro  ao cadastrar Horário , Horário pode já ter sido cadastrado');
                    console.error('Erro ao deletar:', data.message);
                }
            } catch (error) {
                console.error('Erro:', error);
            }
        
        }
        async function deleteHorario(id) {
            
            if (confirm('Tem certeza que deseja deletar este horário?')) {
                try{ 
                    const response = await fetch('http://localhost/horarios/delete_id/' + id, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                })
                const text = await response.text();

                const data = JSON.parse(text);
                if (data.status === 'success') {
                    
                    window.location.replace('http://localhost/horarios');
                } else {
                    alert('Erro ao deletar');
                    console.error('Erro ao deletar:', data.message);
                }
            } catch (error) {
                console.error('Erro:', error);
            }
            }
    }
    async function putHorario(id) {
        const dataValue  = document.getElementById(`edit-data-${id}`).value;
        const horaValue  = document.getElementById(`edit-hora-${id}`).value;
        
        try{ 
            const response = await fetch('http://localhost/horarios/put_id/' + id, {
                method: 'PUT',
                headers: {
                'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                        data: dataValue,
                        time: horaValue 
                })
            })
            const text = await response.text();
            console.log(text);
            const data = JSON.parse(text);
            if (data.status === 'success') {
                window.location.replace('http://localhost/horarios');
            } else {
                alert('Erro ao alterar');
                console.error('Erro ao alterar:', data.message);
            }
        } catch (error) {
            console.error('Erro:', error);
        }
    }

</script>

</body>
</html>
