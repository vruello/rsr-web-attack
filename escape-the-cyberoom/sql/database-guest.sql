DROP DATABASE IF EXISTS cyberoom_guest;
CREATE DATABASE cyberoom_guest;

USE cyberoom_guest;

CREATE TABLE messages (
    id              int NOT NULL AUTO_INCREMENT,
    author          varchar(50),
    date            datetime,
    content         varchar(200) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE clues (
    id              int NOT NULL,
    description     varchar(100),
    PRIMARY KEY(id)
);

INSERT INTO clues (id, description) VALUES (3, "David would do it in 3h.");

INSERT INTO messages(author, date, content) VALUES ('admin', NOW(), "Hi! this brand new messages board is at your disposal should you need to write any information.");

INSERT INTO messages(author, date, content) VALUES ('alice', NOW(), "Yes! I'm already at stage 3! Seems like I'm going to be the first to get out ;)");
