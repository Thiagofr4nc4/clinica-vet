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
    <title>Tratamentos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="home.php">Tela Inicial</a>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center mb-4">Cadastro de Tratamento</h2>
        <form method="POST" id="cadastrarPaciente">
            <div class="form-group">
                <label for="paciente">Paciente</label>
                <select class="form-control" name="paciente" id="pacientes" required>
                    <option disabled selected>Selecione o Paciente</option>
                    <?php include "../Treatments/carregar_pacientes.php"; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea class="form-control" name="descricao" id="descricao" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="data">Data</label>
                <input type="date" class="form-control" name="data" id="data" required>
            </div>

            <button class="btn btn-primary btn-block" type="button" id="cadastrarTratamento">Cadastrar
                Tratamento</button>
        </form>
    </div>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Lista de Tratamentos</h2>
        <table class="table table-striped table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Id Tratamento</th>
                    <th scope="col">Id Paciente</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data</th>
                </tr>
            </thead>
            <tbody id="tabelaTratamentos">
                <?php if ($stmt->rowCount() > 0): ?>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($row['id']); ?></th>
                            <td><?php echo htmlspecialchars($row['patient_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Nenhum Tratamento encontrado</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

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
                                carregarTratamentos();
                                $('#cadastrarPaciente')[0].reset();
                            } else {
                                alert(res.message);
                            }
                        } catch (e) {
                            console.error("Resposta inesperada: ", response);
                            alert("Ocorreu um erro ao processar a resposta.");
                        }
                    },
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
                                $('#tabelaTratamentos').append('<tr><td colspan="4" class="text-center">Nenhum Tratamento encontrado</td></tr>');
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

            carregarTratamentos();
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>