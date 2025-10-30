CREATE TABLE user ( 
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255),
	email VARCHAR(255),
	password CHAR(32),
	UNIQUE (email)
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;

CREATE TABLE image ( 
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	userid INT,
    imagedate DATE NOT NULL,
    filename VARCHAR(255) NOT NULL,
    imagetitle VARCHAR(255) NOT NULL,
    filepath VARCHAR(255) NOT NULL,
    mimetype VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
	FOREIGN KEY (userid) REFERENCES user (id)
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;

CREATE TABLE role (
	id VARCHAR(255) NOT NULL PRIMARY KEY,
	description VARCHAR(255)
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;

CREATE TABLE userrole (
	userid INT NOT NULL,
	roleid VARCHAR(255) NOT NULL,
	PRIMARY KEY (userid, roleid),
	FOREIGN KEY (userid) REFERENCES user (id),
	FOREIGN KEY (roleid) REFERENCES role (id)
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;

CREATE TABLE contact ( 
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	firstname VARCHAR(255),
	lastname VARCHAR(255),
	email VARCHAR(255),
	contactmessage TEXT
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;

# Sample data
# We specify the IDs so they are known when we add related entries

INSERT INTO user (id, name, email, password) VALUES
(1, 'Daniel Phipps', 'daniel@email.com', MD5('passwordcgdb'));

INSERT INTO image (id, userid, imagedate, filename, imagetitle, filepath, mimetype, description) VALUES
(1, 1, CURDATE(), 'car.jpg', 'car', '/images/car.jpg', 'image/jpg', 'image of a car');

INSERT INTO role (id, description) VALUES
('Account Administrator', 'Add, remove, and edit users'),
('Content Editor', 'Add and remove content'),
('Contacts Editor', 'View and remove contact form submissions');

INSERT INTO userrole (userid, roleid) VALUES
(1, 'Account Administrator'),
(1, 'Contacts Editor'),
(1, 'Content Editor');
