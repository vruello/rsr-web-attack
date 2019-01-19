INSERT INTO users (username, password, email, firstname, lastname, job, role) VALUES ('admin', 'b4014495417aab72e29a27a9ed575661f9548e4afafd6bc89358a11eb6d10448', 'admin@admin.fr', 'Be', 'Ef', 'DBAdmin', 5);
INSERT INTO users (username, password, email, firstname, lastname, job, role) VALUES ('chicken', '3cc0d19efcd08f1df0ee3f85dae125199f650a43bdefbdfb700a647a176e53ed', 'chicken@professor.fr', 'Chic', 'Ken', 'RSR Teacher', 2);
INSERT INTO users (username, password, email, firstname, lastname, job, role) VALUES ('veal', '41d17ef2180de7e03cafca4e0d1a75330866981b602ec4424bdff79da8708b47', 'veal@professor.fr', 'Ve', 'Al', 'English Teacher', 2);
INSERT INTO users (username, password, email, firstname, lastname, job, role) VALUES ('salmon', 'a2d9a1f706a871e3f37f8e0c381eaf67149e57c450301d6452cf9f1b4802c242', 'salmon@secretary.fr', 'Sal', 'Mon', 'Secretary', 4);
INSERT INTO users (username, password, email, firstname, lastname, job, role) VALUES ('lobster', '8f0e2f76e22b43e2855189877e7dc1e1e7d98c226c95db247cd1d547928334a9', 'lobster@communication.fr', 'Lob', 'Ster', 'Communication', 3);


INSERT INTO students (firstname, lastname) VALUES ('Tom', 'Ate');
INSERT INTO students (firstname, lastname) VALUES ('Pot', 'Ato');
INSERT INTO students (firstname, lastname) VALUES ('Pep', 'Per');
INSERT INTO students (firstname, lastname) VALUES ('Car', 'Rot');
INSERT INTO students (firstname, lastname) VALUES ('Cel', 'Ery');


INSERT INTO classes (id_users, name, code) VALUES (2, 'Cyber-RSR', 'RSR-42');
INSERT INTO classes (id_users, name, code) VALUES (3, 'Cyber-English', 'ENG-30');

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
