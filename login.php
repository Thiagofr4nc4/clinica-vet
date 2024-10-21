<?php 
    include "conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Login</title>
    
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <br>
        <form method="POST">
            <label>Usuario</label>
            <input type="text" name="usuario" required>
            <br>
            <label>Senha</label>
            <input type="password" required>
            <br>
            <button onclick="submit">Entrar</button>
        </form>
    </div>
</body>
</html>