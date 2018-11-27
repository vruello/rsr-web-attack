INSERT INTO users (username, password, email, firstname, lastname, job) VALUES ('admin1', '25f43b1486ad95a1398e3eeb3d83bc4010015fcc9bedb35b432e00298d5021f7', 'admin@admin.fr', 'Be', 'Ef', 'DBAdmin');
INSERT INTO users (username, password, email, firstname, lastname, job) VALUES ('Chicken', '25f43b1486ad95a1398e3eeb3d83bc4010015fcc9bedb35b432e00298d5021f7', 'chicken@professor.fr', 'Chic', 'Ken', 'RSR Teacher');
INSERT INTO users (username, password, email, firstname, lastname, job) VALUES ('Veal', '25f43b1486ad95a1398e3eeb3d83bc4010015fcc9bedb35b432e00298d5021f7', 'veal@professor.fr', 'Ve', 'Al', 'English Teacher');
INSERT INTO users (username, password, email, firstname, lastname, job) VALUES ('Salmon', '25f43b1486ad95a1398e3eeb3d83bc4010015fcc9bedb35b432e00298d5021f7', 'salmon@secretary.fr', 'Sal', 'Mon', 'Secretary');
INSERT INTO users (username, password, email, firstname, lastname, job) VALUES ('Lobster', '25f43b1486ad95a1398e3eeb3d83bc4010015fcc9bedb35b432e00298d5021f7', 'lobster@communication.fr', 'Lob', 'Ster', 'Communication');


INSERT INTO students (firstname, lastname) VALUES ('Tom', 'Ate');
INSERT INTO students (firstname, lastname) VALUES ('Pot', 'Ato');
INSERT INTO students (firstname, lastname) VALUES ('Pep', 'Per');
INSERT INTO students (firstname, lastname) VALUES ('Car', 'Rot');
INSERT INTO students (firstname, lastname) VALUES ('Cel', 'Ery');


INSERT INTO classes (id_users, name, code) VALUES (1, 'Cyber-RSR', 'RSR-42');
INSERT INTO classes (id_users, name, code) VALUES (1, 'Cyber-English', 'ENG-30');

INSERT INTO grades (id_classes, id_students, grade) VALUES ( 1, 1, 15);
INSERT INTO grades (id_classes, id_students, grade) VALUES ( 2, 1, 18);
INSERT INTO grades (id_classes, id_students, grade) VALUES ( 1, 2, 10);
INSERT INTO grades (id_classes, id_students, grade) VALUES ( 2, 2, 19);
INSERT INTO grades (id_classes, id_students, grade) VALUES ( 1, 3, 12);
INSERT INTO grades (id_classes, id_students, grade) VALUES ( 2, 3, 13);
INSERT INTO grades (id_classes, id_students, grade) VALUES ( 1, 4, 6);
INSERT INTO grades (id_classes, id_students, grade) VALUES ( 2, 4, 15);
INSERT INTO grades (id_classes, id_students, grade) VALUES ( 1, 5, 20);
INSERT INTO grades (id_classes, id_students, grade) VALUES ( 2, 5, 20);

INSERT INTO news (title, content, date) VALUES ('Cybernews', 'Hello this is a message to all the teachers, please use Cyber in all your classes.', '2018-11-10');
INSERT INTO news (title, content, date) VALUES ('Hack-it-n 2018 bis', 'The best cyberconference! Don''t miss it!', '2018-11-24');
INSERT INTO news (title, content, date) VALUES ('A new big server', 'As the current RSR server was feeling lonely, Mr.Touftouf bought a brand new great server to keep him company. This server was obviously not cheap but Touftouf thought it was worth it.', '2018-11-26');
