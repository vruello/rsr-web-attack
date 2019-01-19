
USE RSRWebsite;

-- Nouveaux utilisateurs --

INSERT INTO users (username, password, rank, reported) VALUES ('Ness', sha1('earthbound'), 1, false);
INSERT INTO users (username, password, rank, reported) VALUES ('Ike', sha1('fireemblem'), 1, false);
INSERT INTO users (username, password, rank, reported) VALUES ('Snake', sha1('metalgearsolid'), 1, false);
INSERT INTO users (username, password, rank, reported) VALUES ('Pikachu', sha1('pokemonjaune'), 1, false);
INSERT INTO users (username, password, rank, reported) VALUES ('Sonic', sha1('greenhill'), 1, false);
INSERT INTO users (username, password, rank, reported) VALUES ('Kirby', sha1('kirbyadventure'), 1, false);
INSERT INTO users (username, password, rank, reported) VALUES ('Link', sha1('twilightprincess'), 1, false);
INSERT INTO users (username, password, rank, reported) VALUES ('Luigi', sha1('luigimansion'), 1, false);

INSERT INTO users (username, password, rank, reported) VALUES ('zack', sha1('crisiscore'), 2, false);
INSERT INTO users (username, password, rank, reported) VALUES ('Seiken', sha1('mysticquest'), 2, false);

INSERT INTO users (username, password, rank, reported) VALUES ('MichelDumas', sha1('petitcouteaurouge'), 3, false);

#INSERT INTO users (username, password, rank, reported) VALUES ('user1', sha1('mdp1'), 1, false);
#INSERT INTO users (username, password, rank, reported) VALUES ('user2', sha1('mdp2'), 1, false);
#INSERT INTO users (username, password, rank, reported) VALUES ('modo', sha1('mdpmodo'), 2, false);
#INSERT INTO users (username, password, rank, reported) VALUES ('admin', sha1('mdpadmin'), 3, false);

#UPDATE `users` SET `password` = sha1((select lpad(conv(floor(rand()*pow(36,8)), 10, 36), 8, 0))) WHERE `users`.`username` ='Ness';

-- Nouveaux topics --

INSERT INTO topics (title, id_topic_author, date_creation) VALUES ('La cuisine de Michel Dumas', 1, '2016-10-03 14:30:00');
INSERT INTO topics (title, id_topic_author, date_creation) VALUES ('Répliques de films cultes', 2, '2017-03-10 17:00:00');
INSERT INTO topics (title, id_topic_author, date_creation) VALUES ('Comment cuisiner des ramen', 3, '2018-06-08 15:26:00');

-- Nouveaux messages --

INSERT INTO posts (id_post_topic, id_post_author, date_post, post, reported) VALUES (1, 3, '2018-06-10 16:30:00', 'Quelle est votre recette de cuisine préférée réalisée par Chef Michel Dumas ?', false);
INSERT INTO posts (id_post_topic, id_post_author, date_post, post, reported) VALUES (1, 8, '2018-06-11 09:42:00', 'C ki ?', false);
INSERT INTO posts (id_post_topic, id_post_author, date_post, post, reported) VALUES (1, 2, '2018-06-15 13:27:00', 'La terrine de saumon frais !', false);
INSERT INTO posts (id_post_topic, id_post_author, date_post, post, reported) VALUES (1, 7, '2018-06-17 18:15:00', 'Le petit couteau rose veut goûter...', false);
INSERT INTO posts (id_post_topic, id_post_author, date_post, post, reported) VALUES (1, 6, '2018-06-20 16:05:00', 'Super nickel !', false);

INSERT INTO posts (id_post_topic, id_post_author, date_post, post, reported) VALUES (2, 1, '2018-06-26 08:17:00', 'J\'ai été interrogé par un employé du recensement. J\'ai dégusté son foie avec des fèves au beurre, et un excellent chianti.', false);
INSERT INTO posts (id_post_topic, id_post_author, date_post, post, reported) VALUES (2, 5, '2018-07-10 12:31:00', '...la vie c\'est comme une bôite de chocolat, on sait jamais sur quoiu on va tomber.', false);
INSERT INTO posts (id_post_topic, id_post_author, date_post, post, reported) VALUES (2, 2, '2018-07-17 15:44:00', 'Comment est votre blanquette ?', false);
INSERT INTO posts (id_post_topic, id_post_author, date_post, post, reported) VALUES (2, 3, '2018-07-18 19:56:00', 'Elle est bonne.', false);
INSERT INTO posts (id_post_topic, id_post_author, date_post, post, reported) VALUES (2, 4, '2018-08-01 10:11:00', 'Celui qui me fera manger des champignons il est pas encore né !!', false);

INSERT INTO posts (id_post_topic, id_post_author, date_post, post, reported) VALUES (3, 7, '2018-09-19 16:20:00', 'Post dédié aux amateurs de ramen ! Lachez tous vos conseils culinaires !', false);
INSERT INTO posts (id_post_topic, id_post_author, date_post, post, reported) VALUES (3, 3, '2018-09-25 17:30:00', 'Quelqu\'un saurait comment faire les pâtes en elles-même ?', false);
INSERT INTO posts (id_post_topic, id_post_author, date_post, post, reported) VALUES (3, 5, '2018-09-30 12:59:00', '1
	Tu peux utiliser des la farines pour pain classique. Pour l\'eau il faut abaisser le PH avec du carbonate de sodium', false);
INSERT INTO posts (id_post_topic, id_post_author, date_post, post, reported) VALUES (3, 3, '2018-10-02 10:24:00', 'Je trouve ca où ??', false);
INSERT INTO posts (id_post_topic, id_post_author, date_post, post, reported) VALUES (3, 1, '2018-10-04 20:15:00', 'Tu dois en trouver en ligne. Sinon tu peux en faire en cuisant du bicarbonate de soude.', false);

-- Auteur d'un message --

-- SELECT username FROM users INNER JOIN posts ON users.id_user = posts.id_post_author WHERE id_post = 1; 

-- Date d'un message --

-- SELECT date_post FROM posts WHERE id_post = 2; 

-- Tous les messages d'un topic triés par ID croissant --

-- SELECT post FROM posts WHERE id_post_topic = 1 ORDER BY id_post ASC;

-- Tous les messages reportés --

-- SELECT id_post FROM posts WHERE reported = true;

-- Tous les utilisateurs reportés --

-- SELECT id_user FROM users WHERE reported = true;