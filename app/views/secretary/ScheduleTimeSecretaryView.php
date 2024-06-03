<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Horários Disponíveis</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .select-button {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Horários Disponíveis</h1>
    <nav>
        <a href="/homeSecretaria">Home</a>
    </nav>
    <form id="select-form" method="POST" action="/selecionarHorario" onsubmit="submitForm(); return false;">
        <input type="hidden" name="secretary_id" value="<?php echo htmlspecialchars($_SESSION['secretary_id']); ?>">
        
        <div id="message" style="display: none;"></div>

        <table>
            <tr>
                <th>ID</th>
                <th>Dia da Semana</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Disponível</th>
                <th>Selecionar</th> 
            </tr>
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
        </table>
        <button type="submit" class="select-button">Enviar</button>
    </form>

    <script>
        function submitForm() {
            var form = document.getElementById('select-form');
            var formData = new FormData(form);
            
            // Fazer uma solicitação AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    // Processar a resposta do servidor
                    if (response === 'success') {
                        showMessage('Erro ao agendar horário.', true);
                    } else {
                        showMessage('Agendamento feito com sucesso!', false);
                    }
                    // Recarregar a página após 2 segundos
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    // Se ocorrer um erro na solicitação AJAX
                    showMessage('Erro ao enviar dados do formulário.', false);
                }
            };
            xhr.send(formData);
        }

        function showMessage(message, isSuccess) {
            var messageDiv = document.getElementById('message');
            messageDiv.textContent = message;
            if (isSuccess) {
                messageDiv.style.color = 'red';
            } else {
                messageDiv.style.color = 'green';
            }
            messageDiv.style.display = 'block';
        }
    </script>
</body>

</html>
