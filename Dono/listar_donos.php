<?php 
include '../conexao/conexao.php';

try{
    $stmt = $pdo->prepare("SELECT id, name, contact from owners");
    $stmt->execute();

    if($stmt->rowCount()>0){
        //CRIAR A TABELA DINAMICAMENTE
        echo "<tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Contato</th>
                </tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<tr>
                        <td>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($row['name']) . "</td>
                        <td>" . htmlspecialchars($row['contact']) . "</td>
                    </tr>";
        }
        
    } else {
        echo "<tr><td colspan='3'>Nenhum Dono Cadastrado.</td></tr>";
    } 
} catch(PDOException $e){
    echo "Erro ao listar donos: " .$e->getMessage();
}
?>