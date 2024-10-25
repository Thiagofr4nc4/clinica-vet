<?php 
include '../conexao/conexao.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // RECEBER DADOS DO FORMULÁRIO
    $nomePet = isset($_POST['nomePet']) ? $_POST['nomePet'] : '';
    $especie = isset($_POST['especie']) ? $_POST['especie'] : '';
    $idDono = isset($_POST['idDono']) ? $_POST['idDono'] : '';

    
        try {
            
            $stmt = $pdo->prepare("INSERT INTO patients (name, species, owner_id) VALUES (:name, :species, :owner_id)");

            $stmt->bindParam(':name', $nomePet);
            $stmt->bindParam(':species', $especie);
            $stmt->bindParam(':owner_id', $idDono);

            
            $stmt->execute(); 

            //echo "Pet cadastrado com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao cadastrar Pet: " . $e->getMessage();
        }
    }
?>
