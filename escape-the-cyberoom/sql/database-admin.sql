DROP DATABASE IF EXISTS cyberoom_admin;
CREATE DATABASE cyberoom_admin;

USE cyberoom_admin;

CREATE TABLE users (
    id              int NOT NULL,
    login           varchar(50) NOT NULL,
    password        varchar(100) NOT NULL,
    stage           int,
    secret          int,
    PRIMARY KEY(id)
);

CREATE TABLE stages (
    id              int NOT NULL,
    clue            varchar(100),
    description     varchar(100),
    PRIMARY KEY(id)
);

CREATE TABLE private_messages (
    id              int NOT NULL AUTO_INCREMENT,
    author_id       int,
    date            datetime,
    content         varchar(200) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (author_id) REFERENCES users(id)
);

-- Stages
INSERT INTO stages (id, clue, description) VALUES (1, "Three drunkards, Matthieu, David and Myriam drink a rhum barrel together.", "Experience is the teacher of all things.");
INSERT INTO stages (id, clue, description) VALUES (2, "Matthieu would drink the barrel on his own in 1h.", "Inspiration is one thing. Stealing is another.");
INSERT INTO stages (id, clue, description) VALUES (3, "David would do it in 3h.", "Clues always have a description.");
INSERT INTO stages (id, clue, description) VALUES (4, "Myriam would absorb it in 6h.", "There is no such thing as public opinion. There is only published opinion.");
INSERT INTO stages (id, clue, description) VALUES (5, "How much time do the three drunkards need to drink the whole barrel together?", "Everyone has secrets. It's just a matter of finding out what they are.");

-- Users
INSERT INTO users(id, login, password, stage, secret) VALUES (1, "admin", "$2y$10$ncFJWycVq.zXT6UpooJnjOQ6RHfPDWq.AcPMPGWxWmGTRDrYJfzWm", 6, 90448);

INSERT INTO users(id, login, password, stage, secret) VALUES (2, "guest", "$2y$10$Y/3eD8zFM./1fqLzYc/Mue7X5VSZGY7KRVgE13EhqOvaGuNnv3Vmu", 1, 50177);
INSERT INTO users(id, login, password, stage, secret) VALUES (3, "alice", "$2y$10$KTjpUMk62vuoUeyPOG4rtOFuloXHUk3Qg9bwDtXEFoszs0ncBsPGe", 3, 83428);
INSERT INTO users(id, login, password, stage, secret) VALUES (4, "bob", "$2y$10$i0zyGRXXQOmbF9LduqbFhuXpDo9ydju2PbeA1sk.qgtfqyPPj3XWe", 0, 12313);

-- Private messages [Stage 4]
INSERT INTO private_messages(author_id, date, content) VALUES (4, NOW(), "Clue 4 found: Myriam would absorb it in 6h.");
