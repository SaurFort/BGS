<?php
    session_start();

    if(!$_SESSION['uid']) {
        header("Location: ../login.php");
    } else if($_SESSION['rank'] == "runner") {
        header("Location: ../index.php");
    }

    if($_SESSION['raw-material'] == "no") {
        $_POST['tomato'] = 0;
        $_POST['salad'] = 0;
        $_POST['potato'] = 0;
    }

    include('../assets/php/db_connect.php');

    /*$bp = "Burger poulet : 0";
    $bb = "Burger boeuf : 0";
    $coca = "Coca : 0";
    $sprite = "Sprite : 0";
    $fries = "Frite : 0";
    $ice = "Glace : 0";
    $donut = "Donut : 0";*/
    $message = "";

    if(isset($_POST['submit'])) {
        /*$bp = "Burger poulet : " . $_POST['bp'];
        $bb = "Burger boeuf : " . $_POST['bb'];
        $coca = "Coca : " . $_POST['coca'];
        $sprite = "Sprite : " . $_POST['sprite'];
        $fries = "Frite : " . $_POST['fries'];
        $ice = "Glace : " . $_POST['ice'];
        $donut = "Donut : " . $_POST['donut'];*/

        if($_POST['burger'] || $_POST['soda'] || $_POST['fries'] || $_POST['ice'] || $_POST['donut'] || $_POST['tomato'] || $_POST['salad'] || $_POST['potato']) {
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
                $prodAmount = $_POST['burger'] . "-" . $_POST['soda'] . "-" . $_POST['fries'] . "-" . $_POST['ice'] . "-" . $_POST['donut'] . "-" . $_POST['tomato'] . "-" . $_POST['salad'] . "-" . $_POST['potato'];
                



                $sql = "INSERT INTO comptability (id, seller_id, quantity, type) VALUE ('$id', '$sellerID', '$prodAmount', 'prod')";
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
                <h2>Cuisine</h2>
                <div class="grid">
                    <div class="tile">
                        <img src="https://i.ibb.co/Vg5XqJx/Sans-titre.png"/>
                        <option value="burger">Burger</option>
                        <input name="burger" for="burger" type="number" placeholder="Quantité" style="width: 90%;" value="0" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
                    </div>
                    <div class="tile">
                        <img src="https://i.ibb.co/VQMCjTb/Sans-titre.png"/>
                        <option value="soda">Soda</option>
                        <input name="soda" for="soda" type="number" placeholder="Quantité" style="width: 90%;" value="0" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
                    </div>
                    <div class="tile">
                        <img src="../assets/images/frite.png"/>
                        <option value="fries">Frite</option>
                        <input name="fries" for="fries" type="number" placeholder="Quantité" style="width: 90%;" value="0" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
                    </div>
                    <div class="tile">
                        <img src="../assets/images/glace.png"/>
                        <option value="ice">Glace</option>
                        <input name="ice" for="ice" type="number" placeholder="Quantité" style="width: 90%;" value="0" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
                    </div>
                </div>
                <div class="tile">
                    <img src="../assets/images/donut.png"/>
                    <option value="donut">Donut</option>
                    <input name="donut" for="donut" type="number" placeholder="Quantité" style="width: 50%;" value="0" onkeydown="javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'">
                </div>
                <?php
                    if($_SESSION['raw_material'] == "yes") {
                        echo('<h2>Matière première</h2>
                            <div class="grid">
                                <div class="tile">
                                    <img src="https://i.ibb.co/L1p9gLr/img.png"/>
                                    <option value="tomato">Tomate</option>
                                    <input name="tomato" for="tomato" type="number" placeholder="Quantité" style="width: 90%;" value="0" onkeydown="javascript: return [\'Backspace\',\'Delete\',\'ArrowLeft\',\'ArrowRight\'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!==\'Space\'">
                                </div>
                                <div class="tile">
                                    <img src="https://i.ibb.co/WP673mJ/img.png"/>
                                    <option value="salad">Salade</option>
                                    <input name="salad" for="salad" type="number" placeholder="Quantité" style="width: 90%;" value="0" onkeydown="javascript: return [\'Backspace\',\'Delete\',\'ArrowLeft\',\'ArrowRight\'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!==\'Space\'">
                                </div>
                            </div>
                            <div class="tile">
                                <img src="https://i.ibb.co/PT0KDkZ/img.png"/>
                                <option value="potato">Patate</option>
                                <input name="potato" for="potato" type="number" placeholder="Quantité" style="width: 50%;" value="0" onkeydown="javascript: return [\'Backspace\',\'Delete\',\'ArrowLeft\',\'ArrowRight\'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!==\'Space\'">
                            </div>');
                    }
                ?>
                <button type="submit" name="submit">Enregistrer</button>
            </form>
            <!--<div class="grid-2">
                <p><?php //echo($bp) ?></p>
                <p><?php //echo($bb) ?></p>
                <p><?php //echo($coca) ?></p>
                <p><?php //echo($sprite) ?></p>
                <p><?php //echo($fries) ?></p>
                <p><?php //echo($ice) ?></p>
            </div>
            <p><?php //echo($donut) ?></p>--><br/>
            <a class="bgs-link" href="../index.php">Retour à la page d'accueil</a>
        </main>
    </body>
</html>