<?php
$dbname = 'mysql:host=localhost;dbname=clinica;port=3307;charset=utf8';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO($dbname, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['message' => 'Erro ao conectar ao banco de dados: ' . $e->getMessage()]);
    exit;
}

?>
