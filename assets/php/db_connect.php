<?php
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "bgs";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Echec de la connexion à la base de données : " . mysqli_connect_error() . "<br/>Code d'erreur 12B");
    }
?>
