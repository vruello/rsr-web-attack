#INJECTIONS SQL

##Création

```bash
#Démarrer le serveur
sudo systemctl start apache2
sudo systemctl start mysql
#upgrade
sudo mysql_upgrade -u root -p
#Lancer la console mysql
sudo mysql

#Création d'un user en read only sur la base
CREATE USER 'exo4'@'localhost' IDENTIFIED BY 'mdpexo4';
FLUSH PRIVILEGES;
GRANT ALL ON injectionSQL4.* TO 'exo4'@'localhost' IDENTIFIED BY 'mdpexo4';
QUIT;
sudo systemctl restart mysql

#Vérifier les droits
SHOW GRANTS FOR 'exo4'@'localhost';
#Création de la BDD
CREATE DATABASE IF NOT EXISTS injectionSQL4 CHARACTER SET utf8;
SHOW DATABASES;

#On ouvre la BDD
USE injectionSQL4;
#La base est initialement vide
SHOW TABLES;

#Création d'une table users contenant les username et mdp
CREATE TABLE IF NOT EXISTS users (username VARCHAR(20), password VARCHAR(50));
#La table users est ajoutée
SHOW TABLES;
DESCRIBE users;
#On ajoute un user et l'admin
INSERT INTO `users` (`username`, `password`) VALUES ('admin', 'mdpadmin');
INSERT INTO `users` (`username`, `password`) VALUES ('eleve1', 'mdpeleve1');
INSERT INTO `users` (`username`, `password`) VALUES ('eleve2', 'mdpeleve2');
#On check la table
SELECT * FROM users;
#Création d'un mdp aléatoire à 8 caractères pour l'admin
UPDATE `users` SET `password` = (select lpad(conv(floor(rand()*pow(36,8)), 10, 36), 8, 0)) WHERE `users`.`username` ='admin';

#Création d'une table contenant les catégories du projet de Cyber Plateforme
CREATE TABLE IF NOT EXISTS categories (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
#On ajoute les catégories de projets
INSERT INTO categories (title) VALUES ('Reseau'), ('Reverse'), ('Web'), ('Serveur');
#On check la table
SELECT * FROM categories;

#Création de la table des attaques
CREATE TABLE IF NOT EXISTS projets(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    category_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(category_id) 
    REFERENCES categories(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
#On ajoute les attaques
INSERT INTO projets (title, category_id) VALUES
('Man in the middle', 1),
('Modifier un jeu NES', 2),
('XML', 3),
('Injection SQL', 3),
('Javascript', 3),
('Installation du serveur', 4);
#On check la table
SELECT * FROM projets;

#On quitte mysql
QUIT;
```

#Enlever de la sécu
mysql -u root -p
select @@GLOBAL.secure_file_priv;
quit;
cd /etc/mysql/
emacs my.cnf

<blockquote>
[mysqld]
secure_file_priv=""
</blockquote>

```bash
#On exporte la table
sudo mysqldump -u root injectionSQL4 > injectionSQL4.sql
sudo mv injectionSQL4.sql /var/www/html/Exo4/

```
