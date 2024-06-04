<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Agendamentos</title>
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
        .button {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
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
                    <td>
                        <form method="POST" action="/cancelarHorario">
                            <input type="hidden" name="id_consulta" value="<?php echo htmlspecialchars($appointment['id']); ?>">
                            <button type="submit" class="button">Cancelar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5">Nenhum agendamento encontrado</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
