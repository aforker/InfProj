-- drop the table if it already exists
DROP TABLE IF EXISTS friends;


CREATE TABLE friends (
    id INTEGER NOT NULL AUTO_INCREMENT,
    user_id INTEGER NOT NULL,
    follow_id INTEGER NOT NULL,  --VARCHAR???
    friend BOOLEAN NOT NULL,
    PRIMARY KEY (id)  --
);

-- will id be utilized
