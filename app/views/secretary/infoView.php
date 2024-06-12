
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
            margin-top: 20px;
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

<body>

<div class="container">
    <h2>Informações do Paciente</h2>

    <?php if (!empty($patient) && is_array($patient[0])): ?>
        <table>
            <tr>
                <th>ID</th>
                <td><?php echo isset($patient[0]['id']) ? htmlspecialchars($patient[0]['id']) : 'N/A'; ?></td>
            </tr>
            <tr>
                <th>Nome</th>
                <td><?php echo isset($patient[0]['Nome']) ? htmlspecialchars($patient[0]['Nome']) : 'N/A'; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo isset($patient[0]['email']) ? htmlspecialchars($patient[0]['email']) : 'N/A'; ?></td>
            </tr>
            <tr>
                <th>Telefone</th>
                <td><?php echo isset($patient[0]['telefone']) ? htmlspecialchars($patient[0]['telefone']) : 'N/A'; ?></td>
            </tr>
            <tr>
                <th>CPF</th>
                <td><?php echo isset($patient[0]['cpf']) ? htmlspecialchars($patient[0]['cpf']) : 'N/A'; ?></td>
            </tr>
            <tr>
                <th>Gênero</th>
                <td><?php echo isset($patient[0]['genero']) ? htmlspecialchars($patient[0]['genero']) : 'N/A'; ?></td>
            </tr>
            <tr>
                <th>Data de Nascimento</th>
                <td><?php echo isset($patient[0]['data_de_nascimento']) ? htmlspecialchars($patient[0]['data_de_nascimento']) : 'N/A'; ?></td>
            </tr>
        </table>
    <?php else: ?>
        <p>Informações do paciente não encontradas.</p>
    <?php endif; ?>

    <a class="button" href="/visualizarAgendamentos">Voltar para a lista de agendamentos</a>
</div>

</body>
</html>
