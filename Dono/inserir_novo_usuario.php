<?php
include '../conexao/conexao.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // RECEBER DADOS DO FORMULÁRIO
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $contato = isset($_POST['contato']) ? $_POST['contato'] : '';


    try {

        $stmt = $pdo->prepare("INSERT INTO Owners (name, contact) VALUES (:name, :contact)");

        // Vincular os parâmetros corretamente
        $stmt->bindParam(':name', $nome);
        $stmt->bindParam(':contact', $contato);

        // Executar a declaração
        $stmt->execute();
        //echo "Dono cadastrado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao cadastrar dono: " . $e->getMessage();
    }
}
?>