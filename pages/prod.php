<?php
    session_start();

    if(!$_SESSION['uid']) {
        header("Location: ../login.php");
    } else if($_SESSION['rank'] == "runner") {
        header("Location: ../index.php");
    }   

    include('../assets/php/db_connect.php');

    $bp = "Burger poulet : 0";
    $bb = "Burger boeuf : 0";
    $coca = "Coca : 0";
    $sprite = "Sprite : 0";
    $fries = "Frite : 0";
    $ice = "Glace : 0";
    $donut = "Donut : 0";
    $message = "";

    if(isset($_POST['submit'])) {
        $bp = "Burger poulet : " . $_POST['bp'];
        $bb = "Burger boeuf : " . $_POST['bb'];
        $coca = "Coca : " . $_POST['coca'];
        $sprite = "Sprite : " . $_POST['sprite'];
        $fries = "Frite : " . $_POST['fries'];
        $ice = "Glace : " . $_POST['ice'];
        $donut = "Donut : " . $_POST['donut'];

        if($_POST['bp'] !== "0" || $_POST['bb'] !== "0" || $_POST['coca'] !== "0" || $_POST['sprite'] !== "0" || $_POST['fries'] !== "0" || $_POST['ice'] !== "0" || $_POST['donut'] !== "0") {
            $sql = "SELECT * FROM comptability ORDER BY id DESC";
            $result = $conn->query($sql);

            if($result !== false && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if($row['id'] >= 1) {
                    $id = $row['id'] + 1;
                } else {
                    $id = 1;
                }
                
                $sellerID = $_SESSION['seller_id'];
                $prodAmount = $_POST['bp'] . "-" . $_POST['bb'] . "-" . $_POST['coca'] . "-" . $_POST['sprite'] . "-" . $_POST['fries'] . "-" . $_POST['ice'] . "-" . $_POST['donut'];
                $currentDate = date("Y-m-d");
                

                $sql = "INSERT INTO comptability (id, seller_id, quantity, type, date) VALUE ('$id', '$sellerID', '$prodAmount', 'prod', '$currentDate')";
                if($conn->query($sql) === TRUE) {
                    $message = "<h2 class='success'>Votre production à été ajouté à votre comptabilité avec succès.</h2>";
                } else {
                    $message = "<h2 class='error'>/!\ Erreur, nous n'avons pas réussi à prendre en compte la production dans votre comptabiltié. Code 86A /!\</h2>";
                }
            } else {
                $message = "<h2 class='error'>/!\ Erreur, nous n'avons pas réussi à attribuer un identifiant à votre production. Code 86B /!\</h2>";
            }
        } else {
            $message = "<h2 class='error'>/!\ Erreur, votre production est vide. Code 86C /!\</h2>";
        }
    }
?>
    
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="icon" type="image/png" href="../assets/images/BGS-logo.png">
        <title>Production - Burger-Shot</title>
    </head>
    <body>
        <main class="big-container" align="center">
            <form method="POST">
                <h1>Calculateur de Production</h1>
                <?php if($message !== "") {
                    echo($message);
                } ?>
                <div class="grid">
                    <div class="tiles">
                        <img src="../assets/images/bp.png"/>
                        <option value="bp">Burger poulet</option>
                        <input name="bp" for="bp" type="number" id="bpQuantity" placeholder="Quantité" style="width: 90%;" value="0">
                    </div>
                    <div class="tiles">
                        <img src="../assets/images/bb.png"/>
                        <option value="bb">Burger Boeuf</option>
                        <input name="bb" for="bb" type="number" id="bbQuantity" placeholder="Quantité" style="width: 90%;" value="0">
                    </div>
                    <div class="tiles">
                        <img src="../assets/images/coca.png"/>
                        <option value="coca">Coca</option>
                        <input name="coca" for="coca" type="number" id="cocaQuantity" placeholder="Quantité" style="width: 90%;" value="0">
                    </div>
                    <div class="tiles">
                    <img src="../assets/images/sprite.png"/>
                        <option value="sprite">Sprite</option>
                        <input name="sprite" for="sprite" type="number" id="spriteQuantity" placeholder="Quantité" style="width: 90%;" value="0">
                    </div>
                    <div class="tiles">
                        <img src="../assets/images/frite.png"/>
                        <option value="fries">Frite</option>
                        <input name="fries" for="fries" type="number" id="friesQuantity" placeholder="Quantité" style="width: 90%;" value="0">
                    </div>
                    <div class="tiles">
                        <img src="../assets/images/glace.png"/>
                        <option value="ice">Glace</option>
                        <input name="ice" for="ice" type="number" id="iceQuantity" placeholder="Quantité" style="width: 90%;" value="0">
                    </div>
                </div>
                <div class="tiles">
                    <img src="../assets/images/donut.png"/>
                    <option value="donut">Donut</option>
                    <input name="donut" for="donut" type="number" id="donutQuantity" placeholder="Quantité" style="width: 50%;" value="0">
                </div>
                <button type="submit" name="submit">Enregistrer</button>
            </form>
            <div class="grid-2">
                <p><?php echo($bp) ?></p>
                <p><?php echo($bb) ?></p>
                <p><?php echo($coca) ?></p>
                <p><?php echo($sprite) ?></p>
                <p><?php echo($fries) ?></p>
                <p><?php echo($ice) ?></p>
            </div>
            <p><?php echo($donut) ?></p>
            <a class="bgs-link" href="../index.php">Retour à la page d'accueil</a>
        </main>
    </body>
</html>