<?php
	require_once 'conection.php';

    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    $stmt = $conn->prepare("DELETE FROM  blocks WHERE id = $id");
   
   
   $stmt->execute();


?>
