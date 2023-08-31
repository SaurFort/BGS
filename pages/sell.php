<?php
    session_start();

    if(!$_SESSION['uid']) {
        header("Location: ../login.php");
    } else if($_SESSION['rank'] == "runner") {
        header("Location: ../index.php");
    }   

    include('../assets/php/db_connect.php');

    /*$simpleMenu = "Menu simple : 0";
    $premiumMenu = "Menu premium : 0";
    $maxiMenu = "Menu maxi : 0";
    $doubleMenu = "Menu double: 0";
    $sellBP = "Buger poulet : 0";
    $sellBB = "Burger boeuf : 0";
    $sellCoca = "Coca : 0";
    $sellSprite = "Sprite : 0";
    $sellFries = "Frites : 0";
    $sellIce = "Glace : 0";
    $sellDonut = "Donut : 0";*/
    $message = "";

    if(isset($_POST['submit'])) {
        /*$simpleMenu = "Menu simple : " . $_POST['simple'];
        $premiumMenu = "Menu premium : " . $_POST['premium'];
        $maxiMenu = "Menu maxi : " . $_POST['maxi'];
        $doubleMenu = "Menu double : " . $_POST['double'];
        $sellBP = "Buger poulet : " . $_POST['bp'];
        $sellBB = "Burger boeuf : " . $_POST['bb'];
        $sellCoca = "Coca : " . $_POST['coca'];
        $sellSprite = "Sprite : " . $_POST['sprite'];
        $sellFries = "Frites : " . $_POST['fries'];
        $sellIce = "Glace : " . $_POST['ice'];
        $sellDonut = "Donut : " . $_POST['donut'];*/

        if($_POST['simple'] !== "0" || $_POST['premium'] !== "0" || $_POST['maxi'] !== "0" || $_POST['double'] !== "0" || $_POST['bp'] !== "0" || $_POST['bb'] !== "0" || $_POST['coca'] !== "0" || $_POST['sprite'] !== "0" || $_POST['fries'] !== "0" || $_POST['ice'] !== "0" || $_POST['donut'] !== "0") {
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
                $sellAmount = $_POST['simple'] . "-" . $_POST['premium'] . "-" . $_POST['maxi'] . "-" . $_POST['double'] . "-" . $_POST['bp'] . "-" . $_POST['bb'] . "-" . $_POST['coca'] . "-" . $_POST['sprite'] . "-" . $_POST['fries'] . "-" . $_POST['ice'] . "-" . $_POST['donut'];
                $currentDate = date("Y-m-d");
                

                $sql = "INSERT INTO comptability (id, seller_id, quantity, type) VALUE ('$id', '$sellerID', '$sellAmount', 'sell')";
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
        <title>Vente - Burger-Shot</title>
    </head>
    <body>
        <main class="big-container" align="center">
            <form method="POST">
                <h1>Calculateur de Vente</h1>
                <?php if($message !== "") {
                    echo($message);
                } ?>
                <h2>Menu</h2>
                <div class="grid">
                    <div class="tile">
                        <img src="../assets/images/ms.png"/>
                        <option value="simple">Menu Simple - $40</option>
                        <input name="simple" for="simple" type="number" id="simpleQuantity" placeholder="Quantité" style="width: 90%;" value="0" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
                    </div>
                    <div class="tile">
                        <img src="../assets/images/mp.png"/>
                        <option value="premium">Menu Premium - $50</option>
                        <input name="premium" for="premium" type="number" id="premiumQuantity" placeholder="Quantité" style="width: 90%;" value="0" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
                    </div>
                    <div class="tile">
                        <img src="../assets/images/mm.png"/>
                        <option value="maxi">Menu Maxi - $55</option>
                        <input name="maxi" for="maxi" type="number" id="maxiQuantity" placeholder="Quantité" style="width: 90%;" value="0" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
                    </div>
                    <div class="tile">
                        <img src="../assets/images/md.png"/>
                        <option value="double">Menu Double - $60</option>
                        <input name="double" for="double" type="number" id="doubleQuantity" placeholder="Quantité" style="width: 90%;" value="0" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
                    </div>
                </div>
                <h2>Individuel</h2>
                <div class="grid">
                    <div class="tile">
                        <img src="../assets/images/bp.png"/>
                        <option value="bp">Burger poulet - $35</option>
                        <input name="bp" for="bp" type="number" id="bpQuantity" placeholder="Quantité" style="width: 90%;" value="0" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
                    </div>
                    <div class="tile">
                        <img src="../assets/images/bb.png"/>
                        <option value="bb">Burger boeuf - $35</option>
                        <input name="bb" for="bb" type="number" id="bbQuantity" placeholder="Quantité" style="width: 90%;" value="0" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
                    </div>
                    <div class="tile">
                        <img src="../assets/images/coca.png"/>
                        <option value="coca">Coca - $10</option>
                        <input name="coca" for="coca" type="number" id="cocaQuantity" placeholder="Quantité" style="width: 90%;" value="0" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
                    </div>
                    <div class="tile">
                        <img src="../assets/images/sprite.png"/>
                        <option value="sprite">Sprite - $10</option>
                        <input name="sprite" for="sprite" type="number" id="spriteQuantity" placeholder="Quantité" style="width: 90%;" value="0" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
                    </div>
                    <div class="tile">
                        <img src="../assets/images/frite.png"/>
                        <option value="fries">Frite - $12</option>
                        <input name="fries" for="fries" type="number" id="friesQuantity" placeholder="Quantité" style="width: 90%;" value="0" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
                    </div>
                    <div class="tile">
                        <img src="../assets/images/glace.png"/>
                        <option value="ice">Glace - $12</option>
                        <input name="ice" for="ice" type="number" id="iceQuantity" placeholder="Quantité" style="width: 90%;" value="0" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
                    </div>
                </div>
                <div class="tile">
                    <img src="../assets/images/donut.png"/>
                    <option value="donut">Donut - $25</option>
                    <input name="donut" for="donut" type="number" id="donutQuantity" placeholder="Quantité" style="width: 90%;" value="0" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
                </div>
                <a class="button" href="#lookcalculator" id="#lookcalculator" onclick='calculate()'>Calculer Facture</a>
                <p id="price">Prix : $0</p>
                <button type="submit" name="submit">Enregistrer</button>
            </form>
            <!--<p><?php //echo($simpleMenu) ?></p>
            <p><?php //echo($premiumMenu) ?></p>
            <p><?php //echo($maxiMenu) ?></p>
            <p><?php //echo($doubleMenu) ?></p>--><br/>
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

        var unitPrices = {
            burger: 35,
            soda: 10,
            fries: 12,
            icecream: 12,
            donut: 25
        };

        var totalPrice = 0;

        function updatePrice() {
            var simple = parseInt(document.getElementById("simpleQuantity").value);
            var premium = parseInt(document.getElementById("premiumQuantity").value);
            var maxi = parseInt(document.getElementById("maxiQuantity").value);
            var double = parseInt(document.getElementById("doubleQuantity").value);
            var bp = parseInt(document.getElementById("bpQuantity").value);
            var bb = parseInt(document.getElementById("bbQuantity").value);
            var coca = parseInt(document.getElementById("cocaQuantity").value);
            var sprite = parseInt(document.getElementById("spriteQuantity").value);
            var fries = parseInt(document.getElementById("friesQuantity").value);
            var icecream = parseInt(document.getElementById("iceQuantity").value);
            var donut = parseInt(document.getElementById("donutQuantity").value);

            calculate();
        }

        function calculate() {
            var simple = parseInt(document.getElementById("simpleQuantity").value);
            var premium = parseInt(document.getElementById("premiumQuantity").value);
            var maxi = parseInt(document.getElementById("maxiQuantity").value);
            var double = parseInt(document.getElementById("doubleQuantity").value);
            var bp = parseInt(document.getElementById("bpQuantity").value);
            var bb = parseInt(document.getElementById("bbQuantity").value);
            var coca = parseInt(document.getElementById("cocaQuantity").value);
            var sprite = parseInt(document.getElementById("spriteQuantity").value);
            var fries = parseInt(document.getElementById("friesQuantity").value);
            var icecream = parseInt(document.getElementById("iceQuantity").value);
            var donut = parseInt(document.getElementById("donutQuantity").value);
            simple = simple * menuPrices['simple'];
            premium = premium * menuPrices['premium'];
            maxi = maxi * menuPrices['maxi'];
            double = double * menuPrices['double'];
            bp = bp * unitPrices['burger'];
            bb = bb * unitPrices['burger'];
            coca = coca * unitPrices['soda'];
            sprite = sprite * unitPrices['soda'];
            fries = fries * unitPrices['fries'];
            icecream = icecream * unitPrices['icecream'];
            donut = donut * unitPrices['donut'];

            totalPrice = simple + premium + maxi + double + bp + bb + coca + sprite + fries + icecream + donut;
            var priceElement = document.getElementById("price");
            priceElement.textContent = "Prix : $" + totalPrice;
        }
    </script>
</html>