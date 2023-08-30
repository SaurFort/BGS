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
        <main class="container" align="center">
            <h1>Accueil</h1>
            <h2>Bonjour <?php echo($_SESSION['first_name'] . " " . $_SESSION['last_name']) . " !" ?></h2>
            <div>
                <?php
                    if($_SESSION['rank'] !== "runner") {
                        echo('<button onclick="window.location.href=\'pages/sell.php\'">Calculateur de Vente</button><br/>
                                <button onclick="window.location.href=\'pages/prod.php\'">Calculateur de Prod</button><br/>
                                <button onclick="window.location.href=\'pages/compta.php\'">Comptabilité</button>');
                    }
                ?>
            </div>
        </main>
    </body>
</html>