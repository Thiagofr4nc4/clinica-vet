<?php 
    include  "conexao.php";
    include "funcoes.php";
?>
<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Cadastro Pet</title>
</head>
<body>
    <div class="container">
        <h1>Cadastro Tutor</h1>
        <br>
        <form method="POST">
            <label>Nome do tutor: </label>
            <input type="text" name="nome" required>
            <br>
            <label>Contato: </label>
            <input type="text" name="contato" required>
            <br>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>