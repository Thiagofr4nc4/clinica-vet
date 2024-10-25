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
    <style>
        #modal {
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        #conteudoModal {
            position: relative;
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            width: 80%;
            max-width: 300px;
            text-align: center;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>
    <form id="cadastroPet" method="POST">
        <label for="nomePet">Nome Pet</label>
        <input type="text" id="nomePet" name="nomePet" required>

        <label for="especie">Especie</label>
        <select name="especie" id="especie" required>
            <option value="" disabled selected>Selecione uma Especie</option>
            <option value="Cachorro">Cachorro</option>
            <option value="Gato">Gato</option>
        </select>

        <label for="idDono">Id Dono</label>
        <select id="idDono" name="idDono" required>
            <option value="" disabled selected>Selecione um dono</option>
            <?php include "../Dono/carregar_dono.php"; ?>
        </select>
        <input type="hidden" id="owner_id" name="owner_id" required>
    </form>
    <button onclick="submitForm('cadastroPet')">Cadastrar</button>

    <button id="abrirModal">Adicionar Novo Dono</button>

    <!-- MODAL CADASTRO DONO-->
    <div id="modal">
        <div id="conteudoModal">
            <form id="cadastroDono" method="POST">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" required>

                <label for="contato">Contato</label>
                <input type="text" id="contato" name="contato" required>

                <button type="submit">Cadastrar</button>
            </form>
            <button id="fecharModal">Fechar Modal</button>
        </div>
    </div>

    <a href="../pages/home.php">Tela Inicial</a>

    <script>
        const modal = document.getElementById('modal');
        const abrir = document.getElementById('abrirModal');
        const fechar = document.getElementById('fecharModal');

        abrir.onclick = function () {
            // VERIFICA SE OS CAMPOS DO PET ESTÃO VAZIOS
            if ($('#nomePet').val() === "" || $('#especie').val() === "") {
                alert("Por favor, preencha os campos do pet antes de cadastrar um novo dono.");
            } else {
                modal.style.display = 'block';
            }
        }

        fechar.onclick = function () {
            modal.style.display = 'none';
        }

        // Atualiza a lista de donos
        function atualizarListaDonos() {
            $.ajax({
                type: "GET",
                url: "../Dono/carregar_dono.php",
                success: function (response) {
                    var selectDono = $('#idDono');
                    selectDono.empty();
                    selectDono.append('<option value="" disabled selected>Selecione um dono</option>');
                    selectDono.append(response); // Preencher com os donos atualizados
                },
                error: function (xhr, status, error) {
                    console.error("Erro ao Carregar lista de donos:", error);
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

                    var donoId = response.id;
                    // $('#idDono').html(response);
                    document.getElementById('idDono').innerHTML = response;
                    // $('#owner_id').val(donoId);
                    // atualizarListaDonos(); // Atualiza a lista de donos
                    $('#cadastroDono')[0].reset(); // LIMPA OS CAMPOS
                    $('#modal').hide(); //FECHA O MODAL
                },
                error: function (xhr, status, error) {
                    console.error("Erro ao cadastrar dono:", error);
                }
            });
        });

        function submitForm(formid) {
            // VERIFICA SE SELECIONOU O DONO
            if (formid === 'cadastroPet') {
            }

            document.getElementById(formid).submit();
        }
    </script>
</body>

</html>