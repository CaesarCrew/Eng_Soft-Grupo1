<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Horários Disponíveis</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #A446EE;
        }
        .container {
            text-align: center;
            width: 80%;
            max-width: 1000px;
            padding: 20px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            position: relative;
        }
        .button {
            display: block;
            width: 100%;
            padding: 10px 20px;
            margin-bottom: 15px;
            border: none;
            border-radius: 4px;
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .logout {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 0;
            background: none;
            border: none;
            cursor: pointer;
        }
        .logout button {
            background-color: #d9534f;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .logout button:hover {
            background-color: #c9302c;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .select-button {
            display: block;
            width: 100%;
            padding: 10px 20px;
            margin-top: 15px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .select-button:hover {
            background-color: #0056b3;
        }
        .home-link {
            position: absolute;
            top: 10px;
            left: 10px;
            color: white;
            font-size: 16px;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <a href="/homeSecretaria" class="home-link">Home</a>
    <div class="container">
        <h1>Horários Disponíveis</h1>
        <form id="select-form" method="POST" action="/selecionarHorario" onsubmit="submitForm(); return false;">
            <input type="hidden" name="secretary_id" value="<?php echo htmlspecialchars($_SESSION['secretary_id']); ?>">
            
            <div>
                <label for="cpf">CPF do Paciente:</label>
                <input type="text" id="cpf" name="cpf" required>
            </div>
            
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
    </div>

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
                        showMessage('Agendamento feito com sucesso!', true);
                    } else {
                        
                    }
                    // Recarregar a página após 2 segundos
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    // Se ocorrer um erro na solicitação AJAX
                    showMessage('Erro ao enviar dados do formulário.', true);
                }
            };
            xhr.send(formData);
        }

        function showMessage(message, isSuccess) {
            var messageDiv = document.getElementById('message');
            messageDiv.textContent = message;
            
            messageDiv.style.display = 'block';
        }
    </script>
</body>

</html>
