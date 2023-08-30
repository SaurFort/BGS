<?php
    session_start();

    if(!$_SESSION['uid']) {
        header("Location: ../login.php");
    } else if($_SESSION['rank'] == "runner") {
        header("Location: ../index.php");
    }

    include('../assets/php/db_connect.php');
    include('../assets/php/scomptability.php');

    $sellerID = $_SESSION['seller_id'];
    $actualPrime = 0 . "$";

    $sql = "SELECT * FROM prime WHERE seller_id='$sellerID' ORDER BY date DESC";
    $result = $conn->query($sql);

    if($result !== false && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $actualPrime = $row['prime'] . "$";
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="icon" type="image/png" href="../assets/images/BGS-logo.png">
        <title>Compta - Burger-Shot</title>
    </head>
    <body>
        <main class="big-container" align="center">
            <h1>Comptabilité</h1>
            <h2><?php echo($_SESSION['first_name'] . " " . $_SESSION['last_name'] . " vous avez actuellement " . $actualPrime . " de prime.") ?></h2>
            <?php showComptability($_SESSION['seller_id']) ?>
            <form method="POST" action="comptability/close_comptability.php">
                <button type="submit" name="submit">Cloturer la comptabilité</button>
            </form><br/>
            <a class="bgs-link" href="../index.php">Retour à la page d'accueil</a>
        </main>
    </body>
</html>