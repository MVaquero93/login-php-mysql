# Ejemplo sencillo de login con php-mysql


## Ejecuta el siguiente script mysql:

CREATE DATABASE login_example;
USE login_example;

CREATE TABLE clients (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  email varchar(255)  NOT NULL,
  password varchar(255) NOT NULL,
  CONSTRAINT clients_pk PRIMARY KEY (id)
);

INSERT INTO clients (name, email, password) VALUES
('Marc Vaquero', 'marc@email.com', '$2y$12$kEn1rMXy6eAh/5QUNoMPqe2oq1TEX.fcJ9MunsWI8bW.JLChCMT2G');
INSERT INTO clients (name, email, password) VALUES
('Pepe Goteras', 'pepe@email.com', '$2y$12$TdQwV33v682Z7rWiWHLFr.p2WRhkiUULufe1c.nxi1VTKkHvjL3cC');

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

## Credenciales:
(Esta encriptado con bcrypt)
- marc@email.com : password
- pepe@email.com : 1234

