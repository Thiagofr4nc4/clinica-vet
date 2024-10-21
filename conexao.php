<?php 
    $server = "localhost";
    $user = "root";
    $pass = "root";
    $dbname = "clinica";
    $port = "3307";

    $conn = new mysqli($server, $user, $pass, $dbname, $port);
    if ($conn->connect_error){
        die("Conecction failed: ". $conn->connect_error);
    }
    
    if (!$conn->set_charset("utf8mb4")){
        die("Erro ao definir o charset: ". $conn->error);
    }
?>