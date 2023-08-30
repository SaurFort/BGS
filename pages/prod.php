<?php
    session_start();

    if(!$_SESSION['uid']) {
        header("Location: ../login.php");
    } else if($_SESSION['rank'] == "runner") {
        header("Location: ../index.php");
    }   

    include('../assets/php/db_connect.php');

    $simpleMenu = "Menu simple : 0";
    $premiumMenu = "Menu premium : 0";
    $maxiMenu = "Menu maxi : 0";
    $doubleMenu = "Menu double: 0";
    $message = "";

    if(isset($_POST['submit'])) {
        $simpleMenu = "Menu simple : " . $_POST['simple'];
        $premiumMenu = "Menu premium : " . $_POST['premium'];
        $maxiMenu = "Menu maxi : " . $_POST['maxi'];
        $doubleMenu = "Menu double : " . $_POST['double'];

        if($_POST['simple'] !== "0" || $_POST['premium'] !== "0" || $_POST['maxi'] !== "0" || $_POST['double'] !== "0") {
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
                $sellAmount = $_POST['simple'] . "-" . $_POST['premium'] . "-" . $_POST['maxi'] . "-" . $_POST['double'];
                $currentDate = date("Y-m-d");
                

                $sql = "INSERT INTO comptability (id, seller_id, quantity, type, date) VALUE ('$id', '$sellerID', '$sellAmount', 'sell', '$currentDate')";
                if($conn->query($sql) === TRUE) {
                    $message = "<h2 class='success'>Votre commande à été ajouté à votre comptabilité avec succès.</h2>";
                } else {
                    $message = "<h2 class='error'>/!\ Erreur, nous n'avons pas réussi à prendre en compte la commande dans votre comptabiltié. Code 85A /!\</h2>";
                }
            } else {
                $message = "<h2 class='error'>/!\ Erreur, nous n'avons pas réussi à attribuer un identifiant à votre commande. Code 85B /!\</h2>";
            }
        } else {
            $message = "<h2 class='error'>/!\ Erreur, votre commande est vide. Code 85C /!\</h2>";
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
                <h1>Calculateur de Vente</h1>
                <?php if($message !== "") {
                    echo($message);
                } ?>
                <div class="grid">
                    <div class="tiles">
                        <option value="simple">Menu Simple - $40</option>
                        <input name="simple" for="simple" type="number" id="simpleQuantity" placeholder="Quantité" style="width: 90%;" value="0">
                    </div>
                    <div class="tiles">
                        <option value="premium">Menu Premium - $50</option>
                        <input name="premium" for="premium" type="number" id="premiumQuantity" placeholder="Quantité" style="width: 90%;" value="0">
                    </div>
                    <div class="tiles">
                        <option value="maxi">Menu Maxi - $55</option>
                        <input name="maxi" for="maxi" type="number" id="maxiQuantity" placeholder="Quantité" style="width: 90%;" value="0">
                    </div>
                    <div class="tiles">
                        <option value="double">Menu Double - $60</option>
                        <input name="double" for="double" type="number" id="doubleQuantity" placeholder="Quantité" style="width: 90%;" value="0">
                    </div>
                </div>
                <a class="button" href="#" onclick='calculate()'>Calculer Facture</a>
                <p id="price">Prix : $0</p>
                <button type="submit" name="submit">Enregistrer</button>
            </form>
            <p><?php echo($simpleMenu) ?></p>
            <p><?php echo($premiumMenu) ?></p>
            <p><?php echo($maxiMenu) ?></p>
            <p><?php echo($doubleMenu) ?></p>
            <a class="bgs-link" href="../index.php">Retour à la page d'accueil</a>
        </main>
    </body>

    <script>
        var menuPrices = {
            simple: 40,
            premium: 50,
            maxi: 55,
            double: 60
        };

        var totalPrice = 0;

        function updatePrice() {
            var simple = parseInt(document.getElementById("simpleQuantity").value);
            var premium = parseInt(document.getElementById("premiumQuantity").value);
            var maxi = parseInt(document.getElementById("maxiQuantity").value);
            var double = parseInt(document.getElementById("doubleQuantity").value);

            calculate();
        }

        function calculate() {
            var simple = parseInt(document.getElementById("simpleQuantity").value);
            var premium = parseInt(document.getElementById("premiumQuantity").value);
            var maxi = parseInt(document.getElementById("maxiQuantity").value);
            var double = parseInt(document.getElementById("doubleQuantity").value);
            simple = simple * menuPrices['simple'];
            premium = premium * menuPrices['premium'];
            maxi = maxi * menuPrices['maxi'];
            double = double * menuPrices['double'];

            totalPrice = simple + premium + maxi + double;
            var priceElement = document.getElementById("price");
            priceElement.textContent = "Prix : $" + totalPrice;
        }
    </script>
</html>