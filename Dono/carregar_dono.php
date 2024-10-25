<?php
include "../Conexao/conexao.php";

$stmt = $pdo->prepare("SELECT id, name from owners");
$stmt->execute();
$donos = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($donos as $dono) {
    echo "<option value=\"" . htmlspecialchars($dono['id']) . "\">" . htmlspecialchars($dono['name']) . "</option>";
}