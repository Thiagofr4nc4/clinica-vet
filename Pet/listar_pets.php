<?php 
include '../conexao/conexao.php';

try{
    $stmt = $pdo->prepare("SELECT p.id AS pet_id, p.name AS pet_name, p.species, o.name AS owner_name 
                            FROM patients p 
                            JOIN owners o ON p.owner_id = o.id");
    $stmt->execute();

    if($stmt->rowCount()>0){
        //CRIAR A TABELA DINAMICAMENTE
        echo "<tr>
                    <th>Id</th>
                    <th>Nome do pet</th>
                    <th>Espécie</th>
                    <th>Dono</th>
                </tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<tr>
                        <td>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($row['pet_name']) . "</td>
                        <td>" . htmlspecialchars($row['species']) . "</td>
                        <td>" . htmlspecialchars($row['owner_name']) . "</td>
                    </tr>";
        }
        
    } else {
        echo "<tr><td colspan='4'>Nenhum Pet Cadastrado.</td></tr>";
    } 
} catch(PDOException $e){
    echo "Erro ao listar Pets: " .$e->getMessage();
}
?>