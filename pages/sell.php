<?php
    session_start();

    if(!$_SESSION['uid']) {
        header("Location: ../login.php");
    } else if($_SESSION['rank'] == "runner") {
        header("Location: ../index.php");
    }   

    $simpleMenu = "Menu simple : 0";
    $premiumMenu = "Menu premium : 0";
    $maxiMenu = "Menu maxi : 0";
    $doubleMenu = "Menu double: 0";

    if(isset($_POST['submit'])) {

    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="icon" type="image/png" href="../assets/images/BGS-logo.png">
        <title>Vente - Burger-Shot</title>
    </head>
    <body>
        <main class="big-container" align="center">
            <form>
                <h1>Calculateur de Vente</h1>
                <div class="grid">
                    <div class="tiles">
                        <option value="simple">Menu Simple - $40</option>
                        <input for="simple" type="number" id="quantity" placeholder="Quantité" style="width: 90%;">
                    </div>
                    <div class="tiles">
                        <option value="premium">Menu Premium - $50</option>
                        <input for="premium" type="number" id="quantity" placeholder="Quantité" style="width: 90%;">
                    </div>
                    <div class="tiles">
                        <option value="maxi">Menu Maxi - $55</option>
                        <input for="maxi" type="number" id="quantity" placeholder="Quantité" style="width: 90%;">
                    </div>
                    <div class="tiles">
                        <option value="double">Menu Double - $60</option>
                        <input for="double" type="number" id="quantity" placeholder="Quantité" style="width: 90%;">
                    </div>
                </div>
                <button onclick="calculate()">Calculer Facture</button>
                <p id="price">Prix : $0</p>
                <button type="submit" name="submit">Enregistrer</button>
            </form>
            <p><?php echo($simpleMenu) ?></p>
            <p><?php echo($premiumMenu) ?></p>
            <p><?php echo($maxiMenu) ?></p>
            <p><?php echo($doubleMenu) ?></p>
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
            selectedMenu = document.getElementById("menu").value;
            calculate();
        }

        function calculate() {
            var quantity = parseInt(document.getElementById("quantity").value);
            totalPrice = quantity * menuPrices[selectedMenu];
            var priceElement = document.getElementById("price");
            priceElement.textContent = "Prix : $" + totalPrice;
        }
    </script>
</html>