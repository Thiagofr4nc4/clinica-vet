<?php
include '../conexao/conexao.php';
include "inserir_novo_usuario.php";
?>
<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinica Vet</title>
    <link rel="stylesheet" type="text/css" href="estilo.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <h1>Cadastro de Donos</h1>
    <form id="cadastroDono" method="POST">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required>

        <label for="contato">Contato</label>
        <input type="text" id="contato" name="contato" required>

        <button class="btn btn-primary" type="submit" id="botaoCadastro">Cadastrar</button>
    </form>
    <br>
    <a class="badge badge-info" href="../pages/home.php">Tela Inicial</a>
</body>

</html>