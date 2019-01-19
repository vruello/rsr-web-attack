-- Requêtes de création --

 CREATE DATABASE RSRWebsite;
USE RSRWebsite;

CREATE TABLE users (
    id_user INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    rank INT(1) UNSIGNED NOT NULL,
    reported BOOLEAN
)ENGINE=InnoDB;

CREATE TABLE topics(
    id_topic INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    title VARCHAR(100) NOT NULL,
    id_topic_author INT(4) UNSIGNED NOT NULL,
    date_creation DATETIME NOT NULL,
    CONSTRAINT FOREIGN KEY (id_topic_author) REFERENCES users(id_user)
)ENGINE=InnoDB;

CREATE TABLE posts (
    id_post INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    id_post_topic INT(4) UNSIGNED NOT NULL,
    id_post_author INT(4) UNSIGNED NOT NULL,
    date_post DATETIME NOT NULL,
    post TEXT CHARACTER SET latin1,
    reported BOOLEAN,
    CONSTRAINT FOREIGN KEY (id_post_topic) REFERENCES topics(id_topic),
    CONSTRAINT FOREIGN KEY (id_post_author) REFERENCES users(id_user)
)ENGINE=InnoDB;

-- Création de l'utilisateur --

CREATE USER 'rsrwebsite'@'localhost' IDENTIFIED BY 'teamwebrsr2018';
FLUSH PRIVILEGES;
GRANT SELECT, INSERT, UPDATE ON *.* TO 'rsrwebsite'@'localhost' IDENTIFIED BY 'teamwebrsr2018';
QUIT;

#sudo systemctl restart mysql

SHOW GRANTS FOR 'rsrwebsite'@'localhost';