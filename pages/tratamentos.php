<?php
include '../conexao/conexao.php';
$stmt = $pdo->prepare("SELECT id, patient_id, description, date FROM treatments");
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Tratamentos</title>
</head>

<body>
    <a href="home.php">Tela inicial</a>
    <form method="POST" id="cadastrarPaciente">
        <label for="paciente">Paciente Id</label>
        <select name="paciente" id="pacientes">
            <option disabled selected>Selecione o Paciente</option>
            <?php include "../Treatments/carregar_pacientes.php"; ?>
        </select>

        <label for="descricao">Descrição</label>
        <textarea name="descricao" id="descricao" rows="5" cols="40"></textarea>

        <label for="data">Data</label>
        <input type="date" name="data" id="data">

        <button type="button" id="cadastrarTratamento">Enviar</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>Id Tratamento</th>
                <th>Id Paciente</th>
                <th>Descrição</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody id="tabelaTratamentos">
            <?php if ($stmt->rowCount() > 0): ?>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['patient_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo htmlspecialchars($row['date']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nenhum Tratamento encontrado</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            $('#cadastrarTratamento').on('click', function () {
                var pacienteId = $('#pacientes').val();
                var descricao = $('#descricao').val();
                var data = $('#data').val();
                $.ajax({
                    url: "../Treatments/inserir_novo_tratamento.php",
                    type: "POST",
                    data: {
                        paciente: pacienteId,
                        descricao: descricao,
                        data: data
                    },
                    success: function (response) {
                        try {
                            var res = JSON.parse(response);
                            if (res.status === 'success') {
                                // Recarregar a tabela de tratamentos
                                carregarTratamentos();
                                $('#cadastrarPaciente')[0].reset();
                            } else {
                                alert(res.message);
                            }
                        } catch (e) {
                            console.error("Resposta inesperada: ", response);
                            alert("Ocorreu um erro ao processar a resposta.");
                        }
                    }, // Adicione a vírgula aqui
                    error: function () {
                        alert("Erro ao cadastrar tratamento.");
                    }
                });
            });

            function carregarTratamentos() {
                $.ajax({
                    url: "../Treatments/carregar_tratamentos.php",
                    type: "GET",
                    success: function (response) {
                        $('#tabelaTratamentos').empty();
                        try {
                            var tratamentos = JSON.parse(response);
                            if (tratamentos.length > 0) {
                                tratamentos.forEach(function (tratamento) {
                                    $('#tabelaTratamentos').append(
                                        '<tr>' +
                                        '<td>' + tratamento.id + '</td>' +
                                        '<td>' + tratamento.patient_id + '</td>' +
                                        '<td>' + tratamento.description + '</td>' +
                                        '<td>' + tratamento.date + '</td>' +
                                        '</tr>'
                                    );
                                });
                            } else {
                                $('#tabelaTratamentos').append('<tr><td colspan="4">Nenhum Tratamento encontrado</td></tr>');
                            }
                        } catch (e) {
                            console.error("Erro ao carregar tratamentos: ", response);
                            alert("Ocorreu um erro ao processar a resposta.");
                        }
                    },
                    error: function () {
                        alert("Erro ao carregar tratamentos.");
                    }
                });
            }

            // Chamar carregarTratamentos ao iniciar a página
            carregarTratamentos();
        });
    </script>
</body>

</html>
