#INJECTIONS SQL

##Installation

```bash
#Installation 
sudo apt install apache2 php libapache2-mod-php mysql-server php-mysql
sudo apt install php-curl php-gd php-intl php-json php-mbstring php-xml php-zip
sudo systemctl disable apache2
sudo systemctl disable mysql
```

##Utilisation

```bash
#Démarrer le serveur
sudo systemctl start apache2
sudo systemctl start mysql
#Lancer la console mysql
sudo mysql

#Création d'un user en read only sur la base
CREATE USER 'exo1'@'localhost' IDENTIFIED BY 'mdpexo1';
FLUSH PRIVILEGES;
GRANT SELECT ON *.* TO 'exo1'@'localhost' IDENTIFIED BY 'mdpexo1';
QUIT;
sudo systemctl restart mysql

#Création d'un admin
create user 'admin'@'localhost' identified by 'mdpadmin';
flush privileges;
grant all privileges on *.* to 'admin'@'localhost' identified by 'mdpadmin';
quit;
sudo systemctl restart mysql

#Création de la BDD
CREATE DATABASE injectionSQL1;
SHOW DATABASES;

#On ouvre la BDD
USE injectionSQL1;
#La base est initialement vide
SHOW TABLES;
#Création d'une table users contenant les username et mdp
CREATE TABLE users (username VARCHAR(20), password VARCHAR(50));
#La table users est ajoutée
SHOW TABLES;
DESCRIBE users;
#On ajoute un user et l'admin
INSERT INTO `users` (`username`, `password`) VALUES ('user1', 'mdp1');
INSERT INTO `users` (`username`, `password`) VALUES ('admin', 'mdpadmin');
#On check la table
SELECT * FROM users;
#Création d'un mdp aléatoire à 8 caractères pour l'admin
UPDATE `users` SET `password` = (select lpad(conv(floor(rand()*pow(36,8)), 10, 36), 8, 0)) WHERE `users`.`username` ='admin';
#On quitte mysql
QUIT;
```

```bash
#On exporte la table
sudo mysqldump -u root injectionSQL1 > injectionSQL1.sql
sudo mv injectionSQL1.sql /var/www/html/Exo1/

```
##Autre

```bash
#Adresse de la BDD
SELECT @@datadir;
QUIT;
#Arreter le serveur
sudo systemctl stop mysql
sudo systemctl status mysql

```

```bash
#Détruire la BDD
DROP DATABASE injectionSQL;

```

ALTER TABLE users DROP COLUMN username;
