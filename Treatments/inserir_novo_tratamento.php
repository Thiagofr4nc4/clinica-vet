<?php
include '../conexao/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paciente = isset($_POST['paciente']) ? $_POST['paciente'] : '';
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
    $data = isset($_POST['data']) ? $_POST['data'] : '';

    try {
        $stmt = $pdo->prepare("INSERT INTO treatments (patient_id, description, date) VALUES (:patient_id, :description, :date)");
        $stmt->bindParam(':patient_id', $paciente);
        $stmt->bindParam(':description', $descricao);
        $stmt->bindParam(':date', $data);
        $stmt->execute();

        // OBTER ID DO ULTIMO INSERIDO
        $novoId = $pdo->lastInsertId();

        // RETORNAR RESPOSTA
        echo json_encode([
            'status' => 'success',
            'id' => $novoId
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erro ao cadastrar tratamento: ' . $e->getMessage()
        ]);
    }
}
?>
