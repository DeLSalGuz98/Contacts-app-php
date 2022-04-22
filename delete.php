<?php
    require "database.php";
    session_start();
    $id = $_GET["id"];
    $lookData = $conection -> prepare("SELECT * FROM contacts WHERE id_contact = :id");
    $lookData -> execute([":id"=> $id]);
    
    if($lookData->rowCount() == 0){
        http_response_code(404);
        header("Location: notFound.php");
        return;
    }

    $ownContact = $lookData->fetch(PDO::FETCH_ASSOC);
    if($_SESSION['User']['id'] !== $ownContact['id_contact']){
        http_response_code(403);
        echo("HTTP 403 UNAUTHORIZED");
        return;
    }

    $dropContact = $conection ->prepare("DELETE FROM contacts WHERE id_contact = :id");
    //$dropContact -> bindParam(":id", $id);
    $dropContact -> execute([":id"=> $id]);

    header("Location: home.php");
?>