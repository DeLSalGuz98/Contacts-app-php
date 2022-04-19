<?php
    require "database.php";
    $id = $_GET["id"];
    $lookData = $conection -> prepare("SELECT * FROM contacts WHERE id_contact = :id");
    $lookData -> execute([":id"=> $id]);
    
    if($lookData->rowCount() == 0){
        http_response_code(404);
        header("Location: notFound.php");
        return;
    }

    $dropContact = $conection ->prepare("DELETE FROM contacts WHERE id_contact = :id");
    //$dropContact -> bindParam(":id", $id);
    $dropContact -> execute([":id"=> $id]);

    header("Location: home.php");
?>