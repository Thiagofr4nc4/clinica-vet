<?php
include '../conexao/conexao.php';

$stmt = $pdo->prepare("SELECT id, patient_id, description, date FROM treatments");
$stmt->execute();

$tratamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($tratamentos);