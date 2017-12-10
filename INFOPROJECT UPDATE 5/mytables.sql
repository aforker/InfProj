DROP TABLE IF EXISTS users CASCADE ;
DROP TABLE IF EXISTS attribute CASCADE ;
DROP TABLE IF EXISTS item CASCADE ;
DROP TABLE IF EXISTS list CASCADE ;
-- this is the table for users
CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(120) NOT NULL,
    pass VARCHAR(120),
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

-- insert some records
INSERT INTO list (name) VALUES ('Soccer players');

INSERT INTO item (list_id, name, ordernumber) VALUES (1, 'Lionel Messi', 0);
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (1, 0, 'club', 'text', 'FC Barcelona');
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (1, 1, 'national team', 'text', 'Argentina');
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (1, 2, 'video', 'video', "<iframe src='https://www.youtube.com/embed/0NQL3qZKrTE' frameborder='0' allowfullscreen></iframe>");


INSERT INTO item (list_id, name, ordernumber) VALUES (1, 'Neymar Jr.', 1);
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (2, 0, 'club', 'text', 'PSG');
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (2, 1, 'national team', 'text', 'Brazil');


INSERT INTO list (name) VALUES ('Songs');
INSERT INTO item (list_id, name, ordernumber) VALUES (2, 'Integral', 0);
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (3, 0, 'artist', 'text', 'Pet Shop Boys');
INSERT INTO item (list_id, name, ordernumber) VALUES (2, 'Phantoms', 1);
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (4, 0, 'artist', 'text', 'Alphaville');
INSERT INTO attribute (item_id, ordernumber, label, type, value) VALUES (4, 1, 'video', 'video', '<iframe width="560" height="315" src="https://www.youtube.com/embed/VS4Enm-y8EM" frameborder="0" allowfullscreen></iframe>');