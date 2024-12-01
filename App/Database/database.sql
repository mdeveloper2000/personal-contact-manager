CREATE TABLE contacts (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(35) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    email VARCHAR(50) NOT NULL,
    annotations VARCHAR(200),
    photo VARCHAR(60) NOT NULL DEFAULT '',
    PRIMARY KEY(id),
    UNIQUE(email)
);