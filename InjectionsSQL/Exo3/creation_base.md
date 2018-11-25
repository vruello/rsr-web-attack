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
CREATE USER 'exo3'@'localhost' IDENTIFIED BY 'mdpexo3';
FLUSH PRIVILEGES;
GRANT SELECT ON *.* TO 'exo3'@'localhost' IDENTIFIED BY 'mdpexo3';
QUIT;
sudo systemctl restart mysql

#Création de la BDD
CREATE DATABASE injectionSQL3;
SHOW DATABASES;

#On ouvre la BDD
USE injectionSQL3;
#La base est initialement vide
SHOW TABLES;
#Création d'une table users contenant les username et mdp
CREATE TABLE users (id INT UNSIGNED NOT NULL AUTO_INCREMENT, username VARCHAR(20), password VARCHAR(50), PRIMARY KEY(id));
#La table users est ajoutée
SHOW TABLES;
DESCRIBE users;
#On ajoute un user et l'admin
INSERT INTO `users` (`username`, `password`) VALUES ('user1', 'mdp1');
INSERT INTO `users` (`username`, `password`) VALUES ('admin', 'mdp');
#On check la table
SELECT * FROM users;
#On quitte mysql
QUIT;
```

```bash
#On exporte la table
sudo mysqldump -u root injectionSQL3 > injectionSQL3.sql
sudo mv injectionSQL3.sql /var/www/html/Exo3/


