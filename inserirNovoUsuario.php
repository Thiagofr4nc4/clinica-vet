<?php
include "conexao.php";


$message = "";

//ADICIONAR NOVO USUARIO
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome']) && isset($_POST['contato'])){
        $nome = $conn->real_escape_string($_POST['nome']);
        $contato = $conn->real_escape_string($_POST['contato']);
        $sql = "INSERT INTO owners (name, contact) VALUES ('$nome', '$contato')";
        if($conn->query($sql)===TRUE){
            $message = "Novo tutor inserido com sucesso";
        } else {
            $message = "Erro: " . $sql . "<br>" . $conn->error;

        }
    
}
?> 