Blogging
========

Application Symfony2 pour créer un blog.

Reste encore des améliorations :
- Gestion des utilisateurs
- Gestion des commentaires
- Améliorer le css

Installation : 
--------------

Cloner le projet :

    git clone https://github.com/Inso-61/Blogging.git
    
Se placer dans le dossier :
    
    cd Blogging
    
Installation des dépendances :
    
    composer install
    
Mise à jour de la base :
    
    php app/console doctrine:schema:update --force
    
Droits d'écriture :
    
    sh bash/chmod.sh
    
Créer un super utilisateur : 
----------------------------

Nouvel utilisateur :

    php app/console fos:user:create 
    
Promouvoir en Rôle Admin :
    
    php app/console fos:user:promote    
    
Renseigner : ROLE_ADMIN
