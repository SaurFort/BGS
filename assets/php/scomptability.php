<?php
    function showComptability($sellerID) {
        include('db_connect.php');

        echo("<h3>Aujourd'hui vous avez vendu :</h3>");
        makeSellComptability($sellerID);
        echo("<h3>Aujourd'hui vous avez produit :</h3>");
        makeProdComptability($sellerID);
    }

    function makeSellComptability($sellerID) {
        include('db_connect.php');
        $currentDate = date("Y-m-d");

        $sql = "SELECT COUNT(*) AS compta FROM comptability WHERE seller_id='$sellerID' AND type='sell' AND date='$currentDate';";
        $result = $conn->query($sql);

        if($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $sellCompta = $row['compta'];
        } else {
            $sellCompta = 0;
        }

        if($sellCompta >= 1) {
            $sql = "SELECT * FROM comptability WHERE seller_id='$sellerID' AND type='sell' AND date='$currentDate' ORDER BY id;";
            $result = $conn->query($sql);
    
            if($result !== false && $result->num_rows > 0) {
                $i = 0;
                $simpleMenu = 0;
                $premiumMenu = 0;
                $maxiMenu = 0;
                $doubleMenu = 0;
                $sellBP = 0;
                $sellBB = 0;
                $sellCoca = 0;
                $sellSprite = 0;
                $sellFries = 0;
                $sellIcecream = 0;
                $sellDonut = 0;
                while($i < $sellCompta) {
                    $i++;
                    $row = $result->fetch_assoc();
                    $data = explode("-", $row['quantity']);
                    $simpleMenu += $data[0];
                    $premiumMenu += $data[1];
                    $maxiMenu += $data[2];
                    $doubleMenu += $data[3];
                    $sellBP += $data[4];
                    $sellBB += $data[5];
                    $sellCoca += $data[6];
                    $sellSprite += $data[7];
                    $sellFries += $data[8];
                    $sellIcecream += $data[9];
                    $sellDonut += $data[10];
                }
            }
        } else {
            $sellMessage = "Vous n'avez rien vendu aujourd'hui";
        }

        if($sellCompta >= 1) {
            echo('<div class="grid">
                    <div class="tile">
                        <img src="../assets/images/ms.png"/>
                        <p>Menu simple : ' . $simpleMenu . '</p>
                    </div>
                    <div class="tile">
                        <img src="../assets/images/mp.png"/>
                        <p>Menu premium : ' . $premiumMenu . '</p>
                    </div>
                    <div class="tile">
                        <img src="../assets/images/mm.png"/>
                        <p>Menu maxi : ' . $maxiMenu . '</p>
                    </div>
                    <div class="tile">
                        <img src="../assets/images/md.png"/>
                        <p>Menu double : ' . $doubleMenu . '</p>
                    </div>
                    <div class="tile">
                        <img src="../assets/images/bp.png"/>
                        <p>Burger poulet : ' . $sellBP . '</p>
                    </div>
                    <div class="tile">
                        <img src="../assets/images/bb.png"/>
                        <p>Burger boeuf : ' . $sellBB . '</p>
                    </div>
                    <div class="tile">
                        <img src="../assets/images/coca.png"/>
                        <p>Coca : ' . $sellCoca . '</p>
                    </div>
                    <div class="tile">
                        <img src="../assets/images/sprite.png"/>
                        <p>Sprite : ' . $sellSprite . '</p>
                    </div>
                    <div class="tile">
                        <img src="../assets/images/frite.png"/>
                        <p>Frite : ' . $sellFries . '</p>
                    </div>
                    <div class="tile">
                        <img src="../assets/images/glace.png"/>
                        <p>Glace : ' . $sellIcecream . '</p>
                    </div>
                </div>
                <div class="tile">
                    <img src="../assets/images/donut.png"/>
                    <p>Donut : ' . $sellDonut . '</p>
                </div>');
        } else {
            echo($sellMessage);
        }
    }

    function makeProdComptability($sellerID) {
        include('db_connect.php');
        $currentDate = date("Y-m-d");

        $sql = "SELECT COUNT(*) AS compta FROM comptability WHERE seller_id='$sellerID' AND type='prod' AND date='$currentDate';";
        $result = $conn->query($sql);

        if($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $prodCompta = $row['compta'];
        } else {
            $prodCompta = 0;
        }

        if($prodCompta >= 1) {
            $sql = "SELECT * FROM comptability WHERE seller_id='$sellerID' AND type='prod' AND date='$currentDate' ORDER BY id;";
            $result = $conn->query($sql);
    
            if($result !== false && $result->num_rows > 0) {
                $i = 0;
                $bp = 0;
                $bb = 0;
                $coca = 0;
                $sprite = 0;
                $fries = 0;
                $ice = 0;
                $donut = 0;
                while($i < $prodCompta) {
                    $i++;
                    $row = $result->fetch_assoc();
                    $data = explode("-", $row['quantity']);
                    $bp += $data[0];
                    $bb += $data[1];
                    $coca += $data[2];
                    $sprite += $data[3];
                    $fries += $data[4];
                    $ice += $data[5];
                    $donut += $data[6];
                }
            }
        } else {
            $sellMessage = "Vous n'avez rien produit aujourd'hui";
        }

        if($prodCompta >= 1) {
            echo('<div class="grid">
                    <div class="tile">
                        <img src="../assets/images/bp.png"/>
                        <p>Burger poulet : ' . $bp . '</p>
                    </div>
                    <div class="tile">
                        <img src="../assets/images/bb.png"/>
                        <p>Burger boeuf : ' . $bb . '</p>
                    </div>
                    <div class="tile">
                        <img src="../assets/images/coca.png"/>
                        <p>Coca : ' . $coca . '</p>
                    </div>
                    <div class="tile">
                        <img src="../assets/images/sprite.png"/>
                        <p>Sprite : ' . $sprite . '</p>
                    </div>
                    <div class="tile">
                        <img src="../assets/images/frite.png"/>
                        <p>Frite : ' . $fries . '</p>
                    </div>
                    <div class="tile">
                        <img src="../assets/images/glace.png"/>
                        <p>Glace : ' . $ice . '</p>
                    </div>
                </div>
                <div class="tile">
                    <img src="../assets/images/donut.png"/>
                    <p>Donut : ' . $donut . '</p>
                </div>');
        } else {
            echo($sellMessage);
        }
    }

    function closeComptability($sellerID) {
        include('db_connect.php');
        $currentDate = date("Y-m-d");
        $finalSellMessage = "";
        $finalProdMessage = "";
        $finalSellTitleMessage = "";
        $finalProdTitleMessage = "";

        // Dont look that
        $simpleMenu = 0;
        $premiumMenu = 0;
        $maxiMenu = 0;
        $doubleMenu = 0;
        $sellBP = 0;
        $sellBB = 0;
        $sellCoca = 0;
        $sellSprite = 0;
        $sellFries = 0;
        $sellIcecream = 0;
        $sellDonut = 0;
        $bp = 0;
        $bb = 0;
        $coca = 0;
        $sprite = 0;
        $fries = 0;
        $ice = 0;
        $donut = 0;
        // Now you can look

        $sql = "SELECT COUNT(*) AS compta FROM comptability WHERE seller_id='$sellerID' AND type='sell' AND date='$currentDate';";
        $result = $conn->query($sql);

        if($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $sellCompta = $row['compta'];
        } else {
            $sellCompta = 0;
        }


        if($sellCompta >= 1) {
            $sql = "SELECT * FROM comptability WHERE seller_id='$sellerID' AND type='sell' AND date='$currentDate' ORDER BY id;";
            $result = $conn->query($sql);
    
            if($result !== false && $result->num_rows > 0) {
                $i = 0;
                while($i < $sellCompta) {
                    $i++;
                    $row = $result->fetch_assoc();
                    $currentCommandID = $row['id'];
                    $data = explode("-", $row['quantity']);
                    $simpleMenu += $data[0];
                    $premiumMenu += $data[1];
                    $maxiMenu += $data[2];
                    $doubleMenu += $data[3];
                    $sellBP += $data[4];
                    $sellBB += $data[5];
                    $sellCoca += $data[6];
                    $sellSprite += $data[7];
                    $sellFries += $data[8];
                    $sellIcecream += $data[9];
                    $sellDonut += $data[10];

                    $sql = "DELETE FROM comptability WHERE id='$currentCommandID'";
                    if($conn->query($sql) === TRUE) {
                        print("Cloture de la commande avec succès");
                    } else {
                        print("Echec lors de la cloture de la commande " . $currentCommandID);
                    }
                }
                if($simpleMenu > 0) {
                    $finalSellMessage = "- :simple: Menu simple : " . $simpleMenu . "<br/>";
                } if($premiumMenu > 0) {
                    $finalSellMessage = $finalSellMessage . "- :premium: Menu premium : " . $premiumMenu . "<br/>";
                } if($maxiMenu > 0) {
                    $finalSellMessage = $finalSellMessage . "- :maxi: Menu maxi : " . $maxiMenu . "<br/>";
                } if($doubleMenu > 0) {
                    $finalSellMessage = $finalSellMessage . "- :double: Menu premium : " . $doubleMenu . "<br/>";
                } if($sellBP > 0) {
                    $finalSellMessage = $finalSellMessage . "- :Chicken: Burger poulet : " . $sellBP . "<br/>";
                } if($sellBB > 0) {
                    $finalSellMessage = $finalSellMessage . "- :Beef: Burger boeuf : " . $sellBB . "<br/>";
                } if($sellCoca > 0) {
                    $finalSellMessage = $finalSellMessage . "- :SodaC: Coca : " . $sellCoca . "<br/>";
                } if($sellSprite > 0) {
                    $finalSellMessage = $finalSellMessage . "- :SodaS: Sprite : " . $sellSprite . "<br/>";
                } if($sellFries > 0) {
                    $finalSellMessage = $finalSellMessage . "- :frites: Frite : " . $sellFries . "<br/>";
                } if($sellIcecream > 0) {
                    $finalSellMessage = $finalSellMessage . "- :Glace: Glace : " . $sellIcecream . "<br/>";
                } if($sellDonut > 0) {
                    $finalSellMessage = $finalSellMessage . "- :Donuts: Donut : " . $sellDonut . "<br/>";
                }
                $finalSellTitleMessage = "<p>## Vente :</p>";
            }
        }


        $sql = "SELECT COUNT(*) AS compta FROM comptability WHERE seller_id='$sellerID' AND type='prod' AND date='$currentDate';";
        $result = $conn->query($sql);

        if($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $prodCompta = $row['compta'];
        } else {
            $prodCompta = 0;
        }

        if($prodCompta >= 1) {
            $sql = "SELECT * FROM comptability WHERE seller_id='$sellerID' AND type='prod' AND date='$currentDate' ORDER BY id;";
            $result = $conn->query($sql);

            if($result !== false && $result->num_rows > 0) {
                $i = 0;
                while($i < $prodCompta) {
                    $i++;
                    $row = $result->fetch_assoc();
                    $data = explode("-", $row['quantity']);
                    $bp += $data[0];
                    $bb += $data[1];
                    $coca += $data[2];
                    $sprite += $data[3];
                    $fries += $data[4];
                    $ice += $data[5];
                    $donut += $data[6];
                }

                if($bp > 0) {
                    $finalProdMessage = "- :Chicken: Burger poulet : " . $bp . "<br/>";
                } if($bb > 0) {
                    $finalProdMessage = $finalProdMessage . "- :Beef: Burger boeuf : " . $bb . "<br/>";
                } if($coca > 0) {
                    $finalProdMessage = $finalProdMessage . "- :SodaC: Coca : " . $coca . "<br/>";
                } if($sprite > 0) {
                    $finalProdMessage = $finalProdMessage . "- :SodaS: Sprite : " . $sprite . "<br/>";
                } if($fries > 0) {
                    $finalProdMessage = $finalProdMessage . "- :frites: Frite : " . $fries . "<br/>";
                } if($ice > 0) {
                    $finalProdMessage = $finalProdMessage . "- :Glace: Glace : " . $ice . "<br/>";
                } if($bb > 0) {
                    $finalProdMessage = $finalProdMessage . "- :Donuts: Donut : " . $donut . "<br/>";
                }
                $finalProdTitleMessage = "<p>## Production</p>";
            }
        }

        echo('<h2>Veuillez copier le message suivant dans le channel discord <a class="bgs-link" href="https://discord.com/channels/1095949652970438726/1096102516023902300">Comptabilité</a></h2>
            <div class="tile">
                ' . $finalSellTitleMessage . '<p>' . $finalSellMessage . '</p>
                ' . $finalProdTitleMessage . '<p>' . $finalProdMessage . '
            </div>');

        calculatePrime($sellerID, $simpleMenu, $premiumMenu, $maxiMenu, $doubleMenu, $sellBP, $sellBB, $sellCoca, $sellSprite, $sellFries, $sellIcecream, $sellDonut, $bp, $bb, $coca, $sprite, $fries, $ice, $donut);
    }

    function calculatePrime($sellerID, $simpleMenu, $premiumMenu, $maxiMenu, $doubleMenu, $sellChickenBurger, $sellBeffBurger, $sellCoca, $sellSprite, $sellFries, $sellIcecream, $sellDonut, $chickenBurger, $beefBurger, $coca, $sprite, $fries, $icecream, $donut) {
        include('db_connect.php');
        $currentDate = date("Y-m-d");

        $sql = "SELECT * FROM prime WHERE seller_id='$sellerID' AND date!='$currentDate' ORDER BY date DESC";
        $result = $conn->query($sql);

        if($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $actualPrime = $row['prime'];
        } else {
            $actualPrime = 0;
        }

        $sql = "SELECT * FROM prime ORDER BY id DESC";
        $result = $conn->query($sql);

        if($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lastID = $row['id'] + 1;
        } else {
            $lastID = 1;
        }

        // Sell
        $simpleMenu *= 5;
        $premiumMenu *= 5;
        $maxiMenu *= 6;
        $doubleMenu *= 6;
        $sellBurger = ($sellChickenBurger + $sellBeffBurger) * 2;
        $sellSoda = $sellCoca + $sellSprite;
        $sellCondiment = ($sellFries + $sellIcecream + $sellDonut) * 2;
        // Prod
        $burger = ($chickenBurger + $beefBurger) * 3;
        $condiment = ($fries + $icecream + $donut) * 2;
        $soda = ($coca + $sprite) * 2;

        $total = $simpleMenu + $premiumMenu + $maxiMenu + $doubleMenu + $sellBurger + $sellSoda + $sellCondiment + $burger + $condiment + $soda + $actualPrime;

        $sql = "SELECT * FROM prime WHERE seller_id='$sellerID' AND data='$currentDate' ORDER BY date DESC";
        $result = $conn->query($sql);

        if($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row['id'];
            $sql = "DELETE FROM prime WHERE id='$id'";
            if($conn->query($sql) === TRUE) {
                print('Suppression de la dernière prime de la journée avec succès pour le remplacement');
            } else {
                print('Impossible de supprimer la dernière prime de la journée pour le remplacement');
            }
        }

        $sql = "INSERT INTO prime (id, seller_id, prime, date) VALUE ('$lastID', '$sellerID', '$total', '$currentDate')";
        
        if($conn->query($sql) === TRUE) {
            print("Ajout de la nouvelle prime avec succès");
        } else {
            print("Impossible d'ajouter la nouvelle prime");
        }
    }
?>