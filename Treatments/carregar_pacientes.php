<?php
include "../Conexao/conexao.php";

$stmt = $pdo->prepare("SELECT id FROM patients");
$stmt->execute();
$pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($pacientes as $paciente) {
    echo "<option value=\"" . htmlspecialchars($paciente['id']) . "\">" . htmlspecialchars($paciente['id']) . "</option>";
}


