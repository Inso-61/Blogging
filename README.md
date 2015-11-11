Blogging
========

Application Symfony2 pour créer un blog.

Améliorations bugs etc... :
 https://github.com/Inso-61/Blogging/issues

Installation : 
--------------

Cloner le projet :

    git clone https://github.com/Inso-61/Blogging.git
    
Se placer dans le dossier :
    
    cd Blogging
    
Installation des dépendances :
    
    composer install
    
(Doc. installation de composer, dans le cas où il ne serait pas installé sur votre machine : https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)  

Création de la base : 
    
    php app/console doctrine:database:create
    
Droits d'écriture :
    
    sh bash/chmod.sh
    
Mise à jour de la base :
    
    php app/console doctrine:schema:update --force
    

Créer un super utilisateur : 
----------------------------

Nouvel utilisateur :

    php app/console fos:user:create 
    
Promouvoir en Rôle Admin :
    
    php app/console fos:user:promote    
    
Renseigner : ROLE_ADMIN
