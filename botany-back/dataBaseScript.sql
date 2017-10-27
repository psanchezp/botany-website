
CREATE TABLE Administrator (
    username VARCHAR(50) NOT NULL PRIMARY KEY,
    passwrd VARCHAR(250) NOT NULL, -- not a typo. "password" cannot be name of attribute
    type VARCHAR(30) NOT NULL -- admin, client, or provider
);

CREATE TABLE Client (
    username VARCHAR(50) NOT NULL PRIMARY KEY,
    passwrd VARCHAR(250) NOT NULL, -- not a typo. "password" cannot be name of attribute
    name VARCHAR(30) NOT NULL UNIQUE,
    description VARCHAR(200) NOT NULL,
    type VARCHAR(30) NOT NULL, -- admin, client, or provider
    phone VARCHAR(20),
    address VARCHAR(100),
    email VARCHAR(50)
);

CREATE TABLE Provider (
    username VARCHAR(50) NOT NULL PRIMARY KEY,
    passwrd VARCHAR(250) NOT NULL, -- not a typo. "password" cannot be name of attribute
    name VARCHAR(30) NOT NULL UNIQUE,
    description VARCHAR(200) NOT NULL,
    type VARCHAR(30) NOT NULL, -- admin, client, or provider 
    phone VARCHAR(20),
    address VARCHAR(100),
    email VARCHAR(50)
);

CREATE TABLE Product (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    category VARCHAR(50) NOT NULL,
    measure VARCHAR(10) NOT NULL,
    price FLOAT(30) NOT NULL
);

CREATE TABLE Purchases (
	ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    prov_username VARCHAR(50) NOT NULL,
    prod_id INT NOT NULL,
    transaction_date DATE NOT NULL,
    state BOOLEAN NOT NULL, -- finalized or not
    quantity INT NOT NULL,
    description VARCHAR(200),
    FOREIGN KEY (prov_username) REFERENCES Provider (username)
        ON UPDATE CASCADE,
    FOREIGN KEY (prod_id) REFERENCES Product (ID)
        ON UPDATE CASCADE
);

CREATE TABLE Sales (
	ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    client_username VARCHAR(50) NOT NULL,
    prod_id INT NOT NULL,
    transaction_date DATE NOT NULL,
    state BOOLEAN NOT NULL, -- finalized or not
    quantity INT NOT NULL,
    description VARCHAR(200),
    FOREIGN KEY (client_username) REFERENCES Client (username)
        ON UPDATE CASCADE,
    FOREIGN KEY (prod_id) REFERENCES Product (ID)
        ON UPDATE CASCADE
);
