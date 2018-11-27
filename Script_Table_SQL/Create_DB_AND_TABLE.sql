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
