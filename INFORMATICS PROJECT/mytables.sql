DROP TABLE IF EXISTS master CASCADE ;
DROP TABLE IF EXISTS users CASCADE ;
DROP TABLE IF EXISTS lists CASCADE ;


CREATE TABLE users(
    userid  INT NOT NULL AUTO_INCREMENT,
    username VARCHAR (200) NOT NULL,
    pass    VARCHAR (200) NOT NULL,
    firstname CHARACTER (50),
    lastname CHARACTER (50),
    email VARCHAR (100),
    CONSTRAINT usersPK PRIMARY KEY(userid)
);

CREATE TABLE lists(
    listid INT NOT NULL AUTO_INCREMENT,
    videolink VARCHAR (1000),
    videoname VARCHAR (500),
    videoartist VARCHAR (500),
    videotext VARCHAR (500),
    CONSTRAINT listid PRIMARY KEY(listid)
);
CREATE TABLE master(
    userid INT NOT NULL,
    listid INT NOT NULL,
    type VARCHAR (50) ,
    CONSTRAINT masterPK PRIMARY KEY(userid, listid),
    CONSTRAINT masterFK1 FOREIGN KEY(userid) REFERENCES users(userid) ON DELETE CASCADE,
    CONSTRAINT masterFK2 FOREIGN KEY(listid) REFERENCES lists(listid) ON DELETE CASCADE
);

