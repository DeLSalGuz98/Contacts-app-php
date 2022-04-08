<?php
    $host = "localhost";
    $database = "contacts_app";
    $user = "root";
    $password = "";


try{
    $conection = new PDO("mysql: host= $host; dbname=$database", $user, $password);
    // foreach($conection -> query("SHOW DATABASES") as $raw){
    //     print_r($raw);
    // }
    // die();
}catch(PDOException $error){
    print("ERROR!!: ". $error ->getMessage(). "<br/>");
    die();
}

?>