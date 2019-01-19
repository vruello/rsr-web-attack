CREATE DATABASE Scenario1;

USE Scenario1;

CREATE TABLE users
		(
			id_users 	INT NOT NULL AUTO_INCREMENT,
			username 	VARCHAR(20) NOT NULL UNIQUE,
			password 	VARCHAR(64) NOT NULL,
			email 		VARCHAR(50),
			firstname	VARCHAR(20) NOT NULL,
			lastname 	VARCHAR(20) NOT NULL,
			job		VARCHAR(20) NOT NULL,
			role	TINYINT,
			PRIMARY KEY 	(id_users)
		);

CREATE TABLE students
		(
			id_students 	INT NOT NULL AUTO_INCREMENT,
			firstname	VARCHAR(20) NOT NULL,
			lastname	VARCHAR(20) NOT NULL,
			PRIMARY KEY	(id_students)
		);

CREATE TABLE classes
		(
			id_classes 	INT NOT NULL AUTO_INCREMENT,
			id_users	INT NOT NULL,
			name	 	VARCHAR(20) NOT NULL,
			code 		VARCHAR(10) NOT NULL,
			PRIMARY KEY	(id_classes),
			FOREIGN KEY (id_users) 	REFERENCES users(id_users)
		);

CREATE TABLE news
		(
			id_news 	INT NOT NULL AUTO_INCREMENT,
			title 		VARCHAR(100) NOT NULL,
			content 	VARCHAR(200) NOT NULL,
			date		DATE,
			PRIMARY KEY	(id_news)
		);

CREATE TABLE grades
		(
			id_classes 	INT NOT NULL,
			id_students	INT NOT NULL,
			grade		INT NOT NULL,
			PRIMARY KEY	(id_classes, id_students),
			FOREIGN KEY 	(id_classes) 	REFERENCES classes(id_classes),
			FOREIGN KEY 	(id_students) 	REFERENCES students(id_students)
		);

CREATE TABLE flags
		(
			id INT NOT NULL AUTO_INCREMENT,
			flag VARCHAR(255) NOT NULL,
			PRIMARY KEY (id)
		);
		

CREATE USER 'readonly'@'localhost' IDENTIFIED BY 'readonlypassword';
CREATE USER 'admin'@'localhost' IDENTIFIED BY 'adminpassword';
CREATE USER 'superadmin'@'localhost' IDENTIFIED BY 'superadminpassword';

GRANT SELECT ON Scenario1.classes TO 'readonly'@'localhost';
GRANT SELECT ON Scenario1.grades TO 'readonly'@'localhost';
GRANT SELECT ON Scenario1.news TO 'readonly'@'localhost';
GRANT SELECT ON Scenario1.students TO 'readonly'@'localhost';
GRANT SELECT ON Scenario1.users TO 'readonly'@'localhost';

GRANT SELECT,INSERT,UPDATE,DELETE ON Scenario1.classes TO 'admin'@'localhost';
GRANT SELECT,INSERT,UPDATE,DELETE ON Scenario1.grades TO 'admin'@'localhost';
GRANT SELECT,INSERT,UPDATE,DELETE ON Scenario1.news TO 'admin'@'localhost';
GRANT SELECT,INSERT,UPDATE,DELETE ON Scenario1.students TO 'admin'@'localhost';
GRANT SELECT,INSERT,UPDATE,DELETE ON Scenario1.users TO 'admin'@'localhost';
GRANT SELECT ON Scenario1.flags TO 'admin'@'localhost';

GRANT ALL ON Scenario1.* TO 'superadmin'@'localhost';

