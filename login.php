<?php
    session_start();

    include("assets/php/db_connect.php");
    include("assets/php/utils.php");

    
    $error = "";

    if(isset($_POST['submit'])) {
        $firstName = strtolower($_POST['first_name']);
        $lastName = strtolower($_POST['last_name']);
        /*$firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $firstName = strtolower($firstName);
        $lastName = strtolower($lastName);*/

        $sql = "SELECT * FROM login WHERE first_name='$firstName' AND last_name='$lastName'";
        $result = $conn->query($sql);

        if($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if($firstName == strtolower($row['first_name']) && $lastName == strtolower($row['last_name'])) {
                $id = random(1, 100);
                $sessionID = $firstName . "-" . $lastName . $id;
                $rank = $row['rank'];
                $_SESSION["sessionID"] = $sessionID;
                $_SESSION["first_name"] = $firstName;
                $_SESSION["last_name"] = $lastName;
                $_SESSION["rank"] = $rank;
                $_SESSION['seller_id'] = $row['id'];
                $_SESSION['pwd_verification'] = "no";

                createPerm($rank);
                header("Location: index.php");
                exit();
            } else {
                $error = "<p class='error'>/!\ Le prénom ou le nom est incorrect. /!\</p>";
            }
        } else {
            $error = "<p class='error'>/!\ Le prénom ou le nom est incorrect. /!\</p>";
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="icon" type="image/png" href="assets/images/BGS-logo.png">
        <title>Connexion - Burger-Shot</title>
    </head>
    <body>
        <main class="container">
            <form method="POST" align="center">
                <h1>Connexion</h1>
                <?php echo($error) ?>
                <label for="first_name">Prénom</label>
                <input type="text" name="first_name" placeholder="Prénom"/><br/>
                <label for="last_name">Nom</label>
                <input type="text" name="last_name" placeholder="Nom"/>
                <button type="submit" name="submit">Se connecter</button>
            </form>
        </main>
    </body>
</html>