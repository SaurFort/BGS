<?php
    session_start();

    if(!$_SESSION['uid']) {
        header("Location: ../login.php");
    } else if($_SESSION['rank'] == "runner") {
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../../assets/css/style.css">
        <link rel="icon" type="image/png" href="../../assets/images/BGS-logo.png">
        <title>Cloture de comptabilité - Burger-Shot</title>
    </head>
    <body>
        <main class="big-container" align="center">
            <?php
                if(isset($_POST['submit'])) {
                    include('../../assets/php/scomptability.php');
                
                    closeComptability($_SESSION['seller_id']);
                } else {
                    echo('<h2 class="error">/!\ Vous n\'avez pas cloturer votre comptabilité /!\</h2>');
                }
            ?>
            <br/>
            <a class="bgs-link" href="../../index.php">Retour à la page d'accueil</a>
        </main>
    </body>
</html>