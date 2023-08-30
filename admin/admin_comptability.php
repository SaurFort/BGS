<?php
    session_start();

    include('../assets/php/sadmin.php');

    if(!$_SESSION['uid']) {
        header("Location: ../login.php");
    }
    if(!$_SESSION['rank'] == "patron" || !$_SESSION['rank'] == "co-patron") {
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="icon" type="image/png" href="../assets/images/BGS-logo.png">
        <title>Admin comptabilité - Burger-Shot</title>
    </head>
    <body>
        <main class="container" align="center">
            <?php
                pwdVerification();
            ?>
        </main>
    </body>
</html>