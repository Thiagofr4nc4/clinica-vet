<?php
    include '../conexao/conexao.php';
    include "../Dono/inserir_novo_usuario.php";
?>
<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinica Vet</title>
    <link rel="stylesheet" type="text/css" href="estilo.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <h1>Cadastro de Donos</h1>
    <form id="cadastroDono" method="POST">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required>

        <label for="contato">Contato</label>
        <input type="text" id="contato" name="contato" required>

        <button type="submit">Cadastrar</button>
    </form>

    <h2>Cadastro Pets</h2>
    <form id="cadastroPet" method="POST">
        <label for="nomePet">Nome Pet</label>
        <input type="text" id="nomePet" name="nomePet" required>

        <label for="especie">Especie</label>
        <select name="especie" id="especie" required>
            <option value="" disabled selected>Selecione uma Especie</option>
            <option value="Cachorro sem raça definida">Cachorro sem raça definida</option>
            <option value="Labrador Retriever">Labrador Retriever</option>
            <option value="Bulldog Francês">Bulldog Francês</option>
            <option value="Poodle">Poodle</option>
            <option value="Pit Bull">Pit Bull</option>
            <option value="Shih Tzu">Shih Tzu</option>
            <option value="Golden Retriever">Golden Retriever</option>
            <option value="Beagle">Beagle</option>
            <option value="Yorkshire Terrier">Yorkshire Terrier</option> <!-- Corrigido -->
            <option value="Cocker Spaniel">Cocker Spaniel</option>
            <option value="Rottweiler">Rottweiler</option>
            <option value="Dachshund (ou Teckel)">Dachshund (ou Teckel)</option>
            <option value="Chihuahua">Chihuahua</option>
            <option value="Boxer">Boxer</option> <!-- Corrigido -->
            <option value="Schnauzer">Schnauzer</option>
            <option value="Maltês">Maltês</option>
            <option value="Basset Hound">Basset Hound</option>
            <option value="Cavalier King Charles Spaniel">Cavalier King Charles Spaniel</option>
            <option value="Husky Siberiano">Husky Siberiano</option>
            <option value="Pastor Alemão">Pastor Alemão</option> <!-- Corrigido -->
            <option value="Shiba Inu">Shiba Inu</option>
        </select>

        <label for="idDono">Id Dono</label>
        <select id="idDono" name="idDono" required>
            <option value="" disabled selected>Selecione um dono</option>
            <?php 
            $stmt = $pdo->prepare("SELECT id, name from owners");
            $stmt->execute();
            $donos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($donos as $dono){
                echo "<option value=\"" . htmlspecialchars($dono['id']) . "\">" . htmlspecialchars($dono['name']) . "</option>";
            }
            ?>
        </select>
        <button type="submit">Cadastrar</button>
        
    </form>

    <h2>Listagem Donos</h2>

    <table id="tabelaDonos" border="1">
        <thead>
           <!-- <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Contato</th>
            </tr> -->
        </thead> 
        <tbody id="listaDonos">
            <?php include "../Dono/listar_donos.php";?> 
        </tbody>
    </table>

    <h2>Listagem Pets</h2>

    <table id="tabelaPets" border="1">
        <thead>

        </thead>
        <tbody id="listaPets">
        </tbody>
    </table>

    <h2>Cadastro Tratamentos</h2>
    <table>
    </table>
    <script>
    $(document).ready(function(){
        // FUNÇÃO PARA ATUALIZAR A LISTA DE DONOS
        function atualizarListaDonos(){
            $.ajax({
                url: "listar_donos.php",
                type: 'GET',
                success: function (data) {
                    $('#listaDonos').html(data);
                },
                error: function (xhr, status, error) {
                    console.error("Erro ao atualizar lista de donos:", error);
                }
            });
        }

        // FUNÇÃO PARA ATUALIZAR A LISTA DE PETS
        function atualizarListaPets(){
            $.ajax({
                url: "../Pet/listar_pets.php",
                type: 'GET',
                success: function (data) {
                    $('#listaPets').html(data);
                },
                error: function (xhr, status, error) {
                    console.error("Erro ao atualizar lista de pets:", error);
                }
            });
        }

        // CHAMAR AS FUNÇÕES AO CARREGAR A PÁGINA
        atualizarListaDonos();
        atualizarListaPets();

        // MANIPULADOR DE ENVIO DO FORMULÁRIO PARA DONOS
        $('#cadastroDono').on('submit', function(e){
            e.preventDefault(); 

            $.ajax({
                url: "inserir_novo_usuario.php", 
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                //alert("Dono cadastrado com sucesso!");
                    atualizarListaDonos();
                    $('#cadastroDono')[0].reset(); // LIMPA OS CAMPOS
                },
                error: function (xhr, status, error) {
                    console.error("Erro ao cadastrar dono:", error);
                }
            });
        });

        // ENVIO DO FORMULÁRIO PARA PETS
        $('#cadastroPet').on('submit', function(e){
            e.preventDefault(); 

            $.ajax({
                url: "inserir_novo_pet.php", 
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    //alert("Pet cadastrado com sucesso!");
                    console.log(response);
                    atualizarListaPets();
                    $('#cadastroPet')[0].reset(); // LIMPA OS CAMPOS APÓS O ENVIO
                },
                error: function (xhr, status, error) {
                    console.error("Erro ao cadastrar Pet:", error);
                }
            });
        });
    });
</script>

</body>
</html>
