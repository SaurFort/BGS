# Version 2.0.0
## Client
- Fusion des burgers poulet et boeuf en un seul. De même pour le coca et le sprite.
- Ajout des matières première pour les personnes n'ayant pas les rôles runner ou commis.

## Serveur
- Suppression des IDs inutilisé dans les fichiers `prod.php`, `sell.php`.
- Suppression de l'utilisation des dates dans la table comptabilité.
- Ajout d'un système de permission pour faciliter la gestion des rôles sur la page de prod et les pages admin.
- Ajout du fait de mettre les prénoms et noms en minuscule pour ne plus être sensible à la casse.


# Version 1.1.0
- Ajout des produits à l'unités lors des ventes dans la comptabilité.
- Suppresion des ventes et productions de l'utilisateur lors de la création du message de comptabilité.
- Ajout d'un bouton pour le patron et les co-patrons permettant de réinitialiser la table SQL de comptabilité et de prime.
- Ajout d'un script php `sadmin.php`.
- Ajout d'une vérification par mot de passe pour cloturer la comptabilité de la semaine.
    (Pour changer le mot de passe de la vérification, aller dans `assets/php/sadmin.php`, et modifier la variable `$hashedPWD` situé à la ligne 3.)