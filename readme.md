# MyWishList.app

## C'est quoi ?

MyWishList.app est un projet universitaire composé de :
+ **Pierre Marcolet** *(AlasDiablo et lIotaMiu(Compte utilisé suite a des problèmes sous windows))*
+ **Lucas Burté** *(lucasburte)*
+ **Aurélien Rethiers** *(Aurel-11)*
+ **Émilien Visentini** *(Safyrus)*

## Comment l'installer

1) Clonez le depôt git dans un serveur apache avec `PHP-7.0.0` ou supérieur.

2) Après ceci faire la commande `composer install`, si vous ne l'avez pas, référez vous à [getcomposer.org](https://getcomposer.org/).

3) Pour la création de la base de données, récupérez le fichier SQL situé dans le dossier 'sql' et éxécutez-le sur votre serveur MySQL/MariaDB

4) Pour finir l'installation, créez un fichier `conf.ini` dans `src/conf/` et insérez les données suivantes:
    ```ini
    driver=VosDrivers
    username=VotreUsername
    password=VotreMotdepasse
    host=VotreIp
    database=VotreBaseDeDonnées
    charset=utf-8
    ```

## Lien d'utilisation

+ [Webetu](https://bit.ly/2QSRep8), require un compte de l'utiliversité
+ Status du deploiment:
    + [x] Site web
    + [x] base de donnée
    + [x] deploiment
+ Compte utilisateurs pour le professeurs
    ```
    username: professeur
    mots de passe: php
    ```

## Droits et utilisation

Code sous licence **AGPL-3.0**, lire la licence [ici](https://github.com/AlasDiablo/php-project-2019/blob/master/LICENSE).

## Tâches à faire/en cours

### Niveau 1

+ [x] **~~1 - Afficher une liste de souhaits~~ [Emilien]**
+ [x] **~~2 - Afficher un item d'une liste~~ [Aurélien]**
+ [x] **~~3 - Réserver un item~~ [Emilien & Lucas]**
+ [x] **~~6 - Créer une liste~~ [Aurélien]**
+ [x] **~~8 - Ajouter des items~~ [Aurélien]**
+ [x] **~~14 - Partager une liste~~ [Emilien]**

### Niveau 2

+ [x] **~~4 - Ajouter un message avec sa réservation~~ [Lucas]**
+ [x] **~~5 - Ajouter un message sur une liste~~ [Lucas]**
+ [ ] ***7 - Modifier les informations générales d'une de ses listes [Aurélien]***
+ [x] **~~9 - Modifier un item~~ [Aurélien]**
+ [x] **~~10 - Supprimer un item~~ [Aurélien]**
+ [x] **~~15 - Consulter les réservations d'une de ses listes avant échéance~~ [Emilien]**
+ [X] **~~16 - Consulter les réservations et messages d'une de ses listes après échéance~~ [Emilien]**
+ [x] **~~20 - Rendre une liste publique~~ [Aurélien]**
+ [x] **~~21 - Afficher les listes de souhaits publiques~~ [Aurélien & Pierre]**

### Niveau 3

+ [x] **~~11 - Rajouter une image à un item~~ [Lucas]**
+ [x] **~~12 - Modifier une image d'un item~~ [Lucas]**
+ [x] **~~13 - Supprimer une image d'un item~~ [Lucas]**
+ [x] **~~17 - Créer un compte~~ [Pierre]**
+ [x] **~~18 - S'authentifier~~ [Pierre]**
+ [x] **~~19 - Modifier son compte~~ [Pierre]**
+ [ ] 22 - Créer une cagnotte sur un item
+ [ ] 23 - Participer à une cagnotte
+ [x] **~~24 - Uploader une image~~ [Lucas]**
+ [x] **~~25 - Créer un compte participant~~  [Pierre]**
+ [x] **~~26 - Afficher la liste des créateurs~~  [Pierre]**
+ [x] **~~27 - Supprimer son compte~~ [Pierre]**
+ [x] **~~28 - Joindre des listes à son compte~~  [Pierre]**

### Autres

+ [x] **~~Mise en pages~~ [Pierre (Approfondissement du css) & Lucas (Ossatures principal)]**
+ [ ] Responsive Web Design
+ [x] **~~Ajouter un avatar pour les utilisateurs~~ [Pierre]**
+ [x] **~~Gestion des erreurs HTTP~~ [Pierre & Lucas]**
+ [x] **~~Mise en correlation du code créer par chacun~~ [Pierre & Lucas]**
+ [x] **~~Corrections de bugs majeurs/failles de sécurité~~ [Pierre & Lucas]**
+ [X] **~~Création du set de donnée sur webetu~~ [Emilien]**
