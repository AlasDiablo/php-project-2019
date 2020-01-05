CREATE TABLE item (
    id int(11) NOT NULL,
    liste_id int(11) NOT NULL,
    nom text NOT NULL,
    descr text,
    img text,
    url text,
    tarif decimal(5,2) DEFAULT NULL
);


CREATE TABLE liste (
    no int(11) NOT NULL,
    user_id int(11) DEFAULT NULL,
    titre varchar(255) NOT NULL,
    description text,
    expiration date DEFAULT NULL,
    token varchar(255) DEFAULT NULL
);


CREATE TABLE user (
    username varchar(256) DEFAULT NULL,
    user_id int(100) NOT NULL,
    password_hash varchar(256) DEFAULT NULL,
    email varchar(256) DEFAULT NULL,
    user_level int(1) DEFAULT NULL
);

CREATE TABLE participant (
    user_id int(100) NOT NULL,
    no int(11) NOT NULL
);

INSERT INTO user (username, user_id, password_hash, email, user_level)
VALUES ('anonymous', 0, '', '', 0);

ALTER TABLE item
    ADD PRIMARY KEY (id);

ALTER TABLE liste
    ADD PRIMARY KEY (no);

ALTER TABLE user
    ADD PRIMARY KEY (user_id);

ALTER TABLE participant
    ADD PRIMARY KEY (user_id),
    ADD FOREIGN KEY (user_id) REFERENCES user (user_id),
    ADD FOREIGN KEY (no) REFERENCES liste (no);

ALTER TABLE item
    MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

ALTER TABLE liste
    MODIFY no int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;