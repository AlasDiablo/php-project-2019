# MyWishList.app

## C'est quoi ?

MyWishList.app est un projet universitaire composé de :
+ **Pierre Marcolet** *(AlasDiablo et lIotaMiu(Compte utilisé suite a des probléme sous windows))*
+ **Lucas Burté** *(lucasburte)*
+ **Aurélien Rethiers** *(Aurel-11)*
+ **Émilien Visentini** *(Safyrus)*

## Comment l'installer

1) Clonez le depôt git dans un serveur apache avec `PHP-7.0.0` ou supérieur.

2) Après ceci faire la commande `composer install`, si vous ne l'avez pas, référez vous à [getcomposer.org](https://getcomposer.org/).

3) dans sql vous aurais les commande sql pour mariaDB a executé pour créer la base de donnée demandé plus base

4) Et pour finir l'installation créez un fichier `conf.ini` dans `src/conf/` et y insérez les données suivantes:
    ```ini
    driver=VosDriver
    username=VotreUsername
    password=VotreMotdepasse
    host=VotreIp
    database=VotreBaseDeDonnées
    charset=VotreCharset(utf8 en priorité)
    ```

## Droit et utilisation

Code sous licence **AGPL-3.0**, lire la licence [ici](https://github.com/AlasDiablo/php-project-2019/blob/master/LICENSE).

## Tache a faire et faite

### Niveau 1

+ [ ] 1 - Afficher une liste de souhaits
+ [ ] 2 - Afficher un item d'une liste
+ [ ] 3 - Réserver un item
+ [x] 6 - **~~Créer une liste~~**
+ [ ] 8 - Ajouter des items
+ [ ] 14 - Partager une liste

### Niveau 2

+ [ ] 4 - Ajouter un message avec sa réservation
+ [ ] 5 - Ajouter un message sur une liste
+ [ ] 7 - Modifier les informations générales d'une de ses listes
+ [ ] 9 - Modifier un item
+ [ ] 10 - Supprimer un item
+ [ ] 15 - Consulter les réservations d'une de ses listes avant échéance
+ [ ] 16 - Con sulter les réservations et messages d'une de ses listes après échéance
+ [ ] 20 - Rendre une liste publique
+ [ ] 21 - Afficher les listes de souhaits publiques

### Niveau 3

+ [ ] 11 - Rajouter une image à un item
+ [ ] 12 - Modifier une image d'un item
+ [ ] 13 - Supprimer une image d'un item
+ [x] 17 - **~~Créer un compte~~**
+ [x] 18 - **~~S'authentifier~~**
+ [ ] 19 - ***Modifier son compte***
+ [ ] 22 - Créer une cagnotte sur un item
+ [ ] 23 - Participer à une cagnotte
+ [ ] 24 - Uploader une image
+ [ ] 25 - Créer un compte participant
+ [ ] 26 - Afficher la liste des créateurs 
+ [ ] 27 - Supprimer son compte
+ [ ] 28 - Joindre des listes à son compte
