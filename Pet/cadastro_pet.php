<?php
include "inserir_novo_pet.php"; // Inclui o código para inserir o novo pet
include "../Dono/inserir_novo_usuario.php"; // Inclui o código para inserir o novo dono
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Pet</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            margin-top: 50px;
        }

        h2 {
            font-weight: bold;
            color: #343a40;
            text-align: center;
            margin-bottom: 30px;
        }

        .btn-info {
            margin-top: 15px;
            padding: 10px 20px;
            font-size: 1rem;
        }

        .modal-header,
        .modal-footer {
            background-color: #f8f9fa;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="../pages/home.php">Tela Inicial</a>
    </nav>

    <div class="container form-container">
        <h2>Cadastro de Pet</h2>
        <form id="cadastroPet" method="POST" class="border p-4 rounded bg-white">
            <div class="form-group">
                <label for="nomePet">Nome do Pet:</label>
                <input type="text" id="nomePet" name="nomePet" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="especie">Espécie:</label>
                <select name="especie" id="especie" class="form-control" required>
                    <option value="" disabled selected>Selecione uma Espécie</option>
                    <option value="Cachorro">Cachorro</option>
                    <option value="Gato">Gato</option>
                </select>
            </div>
            <div class="form-group">
                <label for="idDono">Dono:</label>
                <select id="idDono" name="idDono" class="form-control" required>
                    <option value="" disabled selected>Selecione um dono</option>
                    <?php include "../Dono/carregar_dono.php"; ?>
                </select>
                <input type="hidden" id="owner_id" name="owner_id" required>
            </div>
            <button type="button" class="btn btn-info btn-block" onclick="submitForm('cadastroPet')">Cadastrar
                Pet</button>
        </form>

        <button type="button" class="btn btn-secondary btn-block mt-3" data-toggle="modal" data-target="#modalDono"
            id="abrirModal">
            Adicionar Novo Dono
        </button>
    </div>

    <!-- MODAL CADASTRO DONO -->
    <div class="modal fade" id="modalDono" tabindex="-1" role="dialog" aria-labelledby="modalDonoLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDonoLabel">Cadastrar Novo Dono</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="cadastroDono" method="POST">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" id="nome" name="nome" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="contato">Contato:</label>
                            <input type="text" id="contato" name="contato" class="form-control" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" form="cadastroDono">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function atualizarListaDonos() {
            $.ajax({
                type: "GET",
                url: "../Dono/carregar_dono.php",
                success: function (response) {
                    $('#idDono').empty().append('<option value="" disabled selected>Selecione um dono</option>').append(response);
                },
                error: function (xhr, status, error) {
                    console.error("Erro ao carregar lista de donos:", error);
                }
            });
        }

        $('#cadastroDono').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: "../Dono/rotina_inserir_novo_usuario.php",
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    atualizarListaDonos();
                    $('#cadastroDono')[0].reset();
                    $('#modalDono').modal('hide');
                },
                error: function (xhr, status, error) {
                    console.error("Erro ao cadastrar dono:", error);
                }
            });
        });

        function submitForm(formId) {
            $('#' + formId).submit();
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>