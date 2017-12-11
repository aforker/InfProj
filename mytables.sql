DROP TABLE IF EXISTS users CASCADE ;
DROP TABLE IF EXISTS attribute CASCADE ;
DROP TABLE IF EXISTS item CASCADE ;
DROP TABLE IF EXISTS list CASCADE ;
DROP TABLE IF EXISTS friends CASCADE;
-- this is the table for users


CREATE TABLE friends (
    id INTEGER NOT NULL AUTO_INCREMENT,
    user_id INTEGER NOT NULL,
    follow_id INTEGER NOT NULL,  --VARCHAR???
    friend BOOLEAN NOT NULL,
    PRIMARY KEY (id)  --
);

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT, -- to insure no duplication/ unique user each time
    username VARCHAR(120) NOT NULL,
    password VARCHAR(120),
    PRIMARY KEY (id)
);
-- this is the table for lists
CREATE TABLE list (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(120) NOT NULL,
    owner VARCHAR(120),
    ordernumber INT,
    visibility VARCHAR(5) DEFAULT 'TRUE',
    PRIMARY KEY (id)
);
-- items
CREATE TABLE item (
    id INT NOT NULL AUTO_INCREMENT,
    list_id INT NOT NULL,
    name VARCHAR(120) NOT NULL,
    ordernumber INT,
    PRIMARY KEY (id)
);
-- attributes
CREATE TABLE attribute (
    id INT NOT NULL AUTO_INCREMENT,
    item_id INT NOT NULL,
    ordernumber INT ,
    label VARCHAR(120) NOT NULL,
    type VARCHAR(120) NOT NULL,
    value VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)    
);

-- insert some records, sample data

INSERT INTO list (name) VALUES ('Songs');
INSERT INTO item (list_id, name, ordernumber) VALUES (2, 'Integral', 0);
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (3, 0, 'artist', 'text', 'Pet Shop Boys');
INSERT INTO item (list_id, name, ordernumber) VALUES (2, 'Phantoms', 1);
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (4, 0, 'artist', 'text', 'Alphaville');
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (4, 1, 'video', 'video', '<iframe width="560" height="315" src="https://www.youtube.com/embed/VS4Enm-y8EM" frameborder="0" allowfullscreen></iframe>');
