CREATE DATABASE IF NOT EXISTS login_example;
USE login_example;

CREATE TABLE clients (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  CONSTRAINT clients_pk PRIMARY KEY (id)
);

INSERT INTO clients (name) VALUES ('Leo Messi');
INSERT INTO clients (name) VALUES ('Cristiano Ronaldo');
INSERT INTO clients (name) VALUES ('Neymar');

CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  email varchar(255)  NOT NULL,
  password varchar(255) NOT NULL,
  CONSTRAINT clients_pk PRIMARY KEY (id)
);

INSERT INTO users (name, email, password) VALUES
('Marc Vaquero', 'marc@email.com', '$2y$12$6QInd/pnThL/jaOj9/yXWuV0sSQ/K4xCtw5.lKWJ/TrIvALPDo3jW');


CREATE TABLE contracts (
  id int(11) NOT NULL AUTO_INCREMENT,
  client_id int NOT NULL,
  CONSTRAINT contracts_pk PRIMARY KEY (id),
  CONSTRAINT contracts_fk FOREIGN KEY(client_id)
  REFERENCES clients(id) ON DELETE CASCADE
);

INSERT INTO contracts(client_id) VALUES(1);
INSERT INTO contracts(client_id) VALUES(1);
INSERT INTO contracts(client_id) VALUES(1);
INSERT INTO contracts(client_id) VALUES(1);
INSERT INTO contracts(client_id) VALUES(1);
INSERT INTO contracts(client_id) VALUES(1);
INSERT INTO contracts(client_id) VALUES(2);
INSERT INTO contracts(client_id) VALUES(2);
INSERT INTO contracts(client_id) VALUES(2);
INSERT INTO contracts(client_id) VALUES(2);
INSERT INTO contracts(client_id) VALUES(2);
INSERT INTO contracts(client_id) VALUES(2);
INSERT INTO contracts(client_id) VALUES(3);
INSERT INTO contracts(client_id) VALUES(3);
INSERT INTO contracts(client_id) VALUES(3);
INSERT INTO contracts(client_id) VALUES(3);
INSERT INTO contracts(client_id) VALUES(3);
INSERT INTO contracts(client_id) VALUES(3);
INSERT INTO contracts(client_id) VALUES(3);
