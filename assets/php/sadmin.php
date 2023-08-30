<?php
    function pwdVerification() {
        $hashedPWD = "$2y$10\$LKJbGjVGgpAZLQMraILTreH/riqbTC0oqghNNyyQoMKKgcwCGYYNa"; // Password hashed with https://bcrypt.fr/
        $agree = "{$_GET['agree']}";

        if($_SESSION['pwd_verification'] == "yes") {
            requestApprove($agree);
        } else {
            if(isset($_POST['submit'])) {
                $password = $_POST['password'];
                if(password_verify($password, $hashedPWD)) {
                    $_SESSION['pwd_verification'] = "yes";
                    requestApprove($agree);
                } else {
                    echo("<h2 class='error'>/!\ Le mot de passe saisie est incorrecte /!\</h2>
                        <a class='bgs-link' href='./admin_comptability.php?agree=no'>Réessayer</a>");
                }
            } else {
                echo("<form method='POST'>
                        <h2>Pour nous assurez que cela n'est pas une erreur, nous avons besoin de l'entré d'un mot de passe.</h2>
                        <input type='password' name='password' placeholder='Mot de passe' style='width: 90%;'/>
                        <button type='submit' name='submit'>Valider</button>
                    </form>");
            }
        }
    }

    function requestApprove($approval) {
        if($approval == "yes") {
            closeWeeklyComptability();
        } else {
            echo('<h2>Êtes-vous sûr de vouloir cloturer la comptabilité de la semaine ?</h2>
                <div class="grid">
                    <button onclick="window.location.href=\'./admin_comptability.php?agree=yes\'" class="red">Oui</button>
                    <button onclick="window.location.href=\'../index.php\'" class="green">Non</button>
                </div>');
        }
    }

    function closeWeeklyComptability() {
        include('db_connect.php');

        $sql = "TRUNCATE TABLE comptability";
        if($conn->query($sql) === TRUE) {
            $sql = "INSERT INTO comptability (id, seller_id, quantity, type, date) VALUE ('0', 'J-Doe-0', '0-0-0-0-0-0-0-0-0-0-0', 'sell', '2023-08-01')";
            if($conn->query($sql) === TRUE) {
                //print("La table de comptabilité à été vidé avec succès.<br/>");
            } else {
                print("Erreur, la table de comptabilité n'a pas pu être initialiser correctement.<br/>");
            }
        } else {
            print("Erreur, la table de comptabilité n'a pas pu être vidé.<br/>");
        }

        $sql = "TRUNCATE TABLE prime";
        if($conn->query($sql) === TRUE) {
            //print("La table de prime à été vidé avec succès.");
        } else {
            print("Erreur, la table de prime n'a pas pu être vidé.");
        }

        echo('<h2>La comptabilité à bien été réinitialiser.</h2>
            <a class="bgs-link" href="../index.php">Retour à la page d\'accueil</a>');
    }
?>