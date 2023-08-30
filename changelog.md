# Version 1.1.0
- Ajout des produits à l'unités lors des ventes dans la comptabilité.
- Suppresion des ventes et productions de l'utilisateur lors de la création du message de comptabilité.
- Ajout d'un bouton pour le patron et les co-patrons permettant de réinitialiser la table SQL de comptabilité et de prime.
- Ajout d'un script php `sadmin.php`.
- Ajout d'une vérification par mot de passe pour cloturer la comptabilité de la semaine.
    (Pour changer le mot de passe de la vérification, aller dans `assets/php/sadmin.php`, et modifier la variable `$hashedPWD` situé à la ligne 3.)