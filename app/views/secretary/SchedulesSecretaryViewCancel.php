<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Agendamentos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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

        .button-container {
            display: flex;
            align-items: center;
        }

        .button {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-right: 5px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .info-button {
            padding: 5px 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .info-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>Agendamentos</h1>
    <nav>
        <a href="/homeSecretaria">Home</a>
    </nav>
    <table>
        <tr>
            <th>ID Consulta</th>
            <th>Data</th>
            <th>Hora</th>
            <th>Criado Por</th>
            <th>Ação</th>
        </tr>
        <?php if (!empty($appointments)): ?>
            <?php foreach ($appointments as $appointment): ?>
                <tr>
                    <td><?php echo htmlspecialchars($appointment['id']); ?></td>
                    <td><?php echo htmlspecialchars(date('d/m/Y', strtotime($appointment['data']))); ?></td>
                    <td><?php echo htmlspecialchars($appointment['hora']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['tipo_criador']); ?></td>
                    <td class="button-container">
                        <button type="button" class="button" onclick="cancelAppointment(<?php echo htmlspecialchars($appointment['id']); ?>)">Cancelar</button>
                        <form id="cancel-form-<?php echo htmlspecialchars($appointment['id']); ?>" method="POST" action="/cancelarHorario" style="display: none;">
                            <input type="hidden" name="id_consulta" value="<?php echo htmlspecialchars($appointment['id']); ?>">
                        </form>
                        <form method="POST" action="/visualizarAgendamentos/informacoes">
                            <input type="hidden" name="id_consulta" value="<?php echo htmlspecialchars($appointment['id']); ?>">
                            <button type="submit" class="info-button">Ver Informações</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5">Nenhum agendamento encontrado</td></tr>
        <?php endif; ?>
    </table>
    <script>
        function cancelAppointment(appointmentId) {
            var form = document.getElementById('cancel-form-' + appointmentId);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    location.reload();
                } else {
                    console.error('Erro ao cancelar o agendamento');
                }
            };
            xhr.send(new FormData(form));
        }
    </script>
</body>
</html>
