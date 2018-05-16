<?php
$serverName = 'localhost';
$userName = 'root';
$password = 'stagiaire';
$dbName = 'myDB';


    try {

        // $conn = new PDO("mysql:host=".$serverName,$userName , $password);
        // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $sql = "CREATE DATABASE myDB";
        // $conn-> exec($sql);
        // echo 'Database created successfuly<br>';
        $conn = new PDO ("mysql:host=".$serverName.";dbname=".$dbName, $userName, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // $sql = "CREATE TABLE clients (
        //     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        //     firstname VARCHAR(30) NOT NULL,
        //     lastname VARCHAR(30) NOT NULL,
        //     email VARCHAR(50),
        //     C_url VARCHAR (50),
        //     comment text,
        //     gender VARCHAR (10)
        //     )";
    
        //     $conn->exec($sql);
        //     echo "Table Clients created successfully";
    }
    catch(PDOException $e){
        
        echo "Error : <br>" . $e->getMessage();
    }


?>

