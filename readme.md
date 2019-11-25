# MyWishList.app

## C'est quoi ?

MyWishList.app est un projet universitaire composé de :
+ **Pierre Marcolet** *(AlasDiablo)*
+ **Lucas Burté** *(lucasburte)*
+ **Aurélien Rethiers** *(Aurel-11)*
+ **Émilien Visentini** *(Safyrus)*

## Comment l'installer

1) Clonez le depôt git dans un serveur apache avec `PHP-7.0.0` ou supérieur.

2) Après ceci faire la commande `composer install`, si vous ne l'avez pas, référez vous à [getcomposer.org](https://getcomposer.org/).

3) Et pour finir l'installation créez un fichier `conf.ini` dans `src/conf/` et y insérez les données suivantes:
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