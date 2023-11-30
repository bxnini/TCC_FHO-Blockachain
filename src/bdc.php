<?php

   require_once 'connection.php';

    $previousHash = $_POST['previousHash'];
    $data = $_POST['data'];
    $hash = $_POST['hash'];
    

    $stmt = $conn->prepare("INSERT INTO  tbdcadprod (previousHash, data, hash) VALUES (?,?,?)"); 

    $novo_bloco = array($previousHash, $data, $hash);


      if($stmt->execute($novo_bloco)){
        echo "<script type='text/javascript'>alert('Cadastro realizado com Sucesso!');</script>";
        header("Location: index.php");
      }
    

    
?>