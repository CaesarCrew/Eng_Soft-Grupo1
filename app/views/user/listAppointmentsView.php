<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Agendamentos</title>
</head>
<body>
    <h1>Meus Agendamentos</h1>
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
            <?php foreach ($appointments as $appointment) { ?>
                <tr>
                    <td><?php echo $appointment["dia_da_semana"]; ?></td>
                    <td><?php echo $appointment["data"]; ?></td>
                    <td><?php echo $appointment["hora"]; ?></td>
                    <td>
                        <form method="POST" action="/horarios/cancel_id/<?php echo $appointment["id"]; ?>">
                            <button type="submit">Cancelar</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
