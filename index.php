<?php
    session_start();

    if(!$_SESSION['uid']) {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="icon" type="image/png" href="assets/images/BGS-logo.png">
        <title>Accueil - Burger-Shot</title>
    </head>
    <body>
        <main class="container">

        </main>
    </body>
</html>