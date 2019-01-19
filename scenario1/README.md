# Challenge "Modification de notes"

## Comptes

- user: admin | password: zE?qGJSatgs=_73f | role: ADMIN
- user: chicken | password: CW3PMTYsAB!psp7q | role: TEACHER
- user: veal | password: 09112016 | role: TEACHER
- user: salmon | password: cGWhbAUmTe4JGf4J | role: SECRETARY
- user: lobster | password: passw0rd | role: COMMUNICATION

## Lancer 

Avec docker : 
``` 
sudo docker run -p "80:80" -v ${PWD}:/app -v ${PWD}/mysql:/mysql mattrayner/lamp:latest-1604-php7
``` 

Créer la base `Scenario1`. Exécuter les scripts : 
1. Create_DB_AND_TABLE
2. Insert_INTO_Tables

Modifier le mot de passe de la base de données contenu dans `config/database.php`.

La racine du site se trouve dans /public (il faudra donc que le domaine pointe vers là). 

## Déroulement (indices)

Objectif : Vous êtes Car Rot. Vous souhaitez modifier votre note la plus basse du semestre.

- Accès à l'image sur le bureau donne indice sur le login et mot de passe du professeur veal.
- Depuis le compte, Chercher tous les cours pour trouver votre note la plus basse.
- On s'apperçoit qu'on ne peut pas modifier, mais il y a peut être d'autres tables... Chercher les utilisateurs.
- Un des mots de passe est peut être faible...
- La secrétaire vient souvent sur l'écran d'accueil...
- La secrétaire upload des fichiers .csv et peut les récupérer après.

## Gestion des flags

>>> Créer deux utilisateurs : superadmin, admin, readonly.

Tables notes => lisible par readonly, modifiable par admin
Table flags => lisible par admin, modifiable par superadmin

>>> De base on accède au site en tant que readonly, mais on a aussi les logs et une co\
nnexion ouverte avec admin

Premier flag = S'affiche si connecté en tant que veal
Deuxième flag : Une des notes "masquée" est en faite un flag
Troisième flag : Flag une fois connecté en tant que lobster
Quatrième flag : Connecté en tant que salmon
Cinquième flag : Upload d'un fichier avec extension .phphidden (=> exploit XXE pour le\
cture)
Sixième flag : modification de la note => connexion en tant que admin (donc note modif\
iable). Ya un process exécuté en tant que root avec des droits en lecture et écriture \
que pour root qui se connecte en tant que superadmin, qui vérifie si la note a changé,\
 et si la note a changé ajoute le flag dans la bdd.

       
