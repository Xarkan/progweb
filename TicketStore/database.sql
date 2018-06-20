DROP DATABASE IF EXISTS DB_biglietti;
CREATE DATABASE DB_biglietti;
USE DB_biglietti;


CREATE TABLE evento (
  code          int             NOT NULL    AUTO_INCREMENT,
  nome          varchar(20)     NOT NULL,
  path_img      varchar(40)     NOT NULL,
  nome_img      varchar(40)     NOT NULL,

  PRIMARY KEY(code)
  
);

CREATE TABLE utente_r (
  mail          varchar(40)     NOT NULL,
  psw           varchar(132)    NOT NULL,
  nome          varchar(40)     NOT NULL,
  PRIMARY KEY(mail)
);

CREATE TABLE ordine (
  codo           int     	NOT NULL    AUTO_INCREMENT,
  mail           varchar(40)    NOT NULL,
  data_ordine    datetime        	NOT NULL,
 
  PRIMARY KEY (codo)

);

CREATE TABLE luogo (
  indirizzo     varchar(40)     NOT NULL,

  PRIMARY KEY (indirizzo)
);

CREATE TABLE zona (
  nome          varchar(40)     NOT NULL,
  indirizzo     varchar(40)     NOT NULL,
  capacita      int             NOT NULL,
  
  PRIMARY KEY (nome, indirizzo),
  FOREIGN KEY (indirizzo) REFERENCES luogo(indirizzo)
);



CREATE TABLE evento_spec (
  code          int             NOT NULL,
  data_evento   datetime        NOT NULL,
  indirizzo     varchar(40)     NOT NULL,
  tipo          varchar(10)     NOT NULL,
  casa          varchar(20)     NULL,
  ospite        varchar(20)     NULL,
  compagnia     varchar(20)     NULL,
  artista       varchar(20)     NULL,

  PRIMARY KEY (code, data_evento),
  FOREIGN KEY (code) REFERENCES evento(code),
  FOREIGN KEY (indirizzo) REFERENCES luogo(indirizzo)
);

CREATE TABLE partecipazione (
  code          int             NOT NULL,
  data_evento   datetime        NOT NULL,
  zona          varchar(20)     NOT NULL,
  indirizzo     varchar(40)     NOT NULL,
  prezzo        int             NOT NULL,

  PRIMARY KEY (code, data_evento, zona, indirizzo),
  FOREIGN KEY (code, data_evento) REFERENCES evento_spec(code, data_evento),
  FOREIGN KEY (zona, indirizzo) REFERENCES  zona(nome, indirizzo)
);

CREATE TABLE biglietto (
  codb          int             NOT NULL    AUTO_INCREMENT,
  code          int             NOT NULL,
  codo          int	        NULL,
  mail          varchar(40)     NULL,
  evento        varchar(40)     NOT NULL,
  data_evento   datetime        NOT NULL,
  zona          varchar(40)     NOT NULL,
  indirizzo     varchar(40)     NOT NULL,
  fila          int             NULL,
  posto         int             NULL,

  PRIMARY KEY (codb, code, data_evento, zona, indirizzo),
  FOREIGN KEY (code, data_evento) REFERENCES evento_spec(code, data_evento),
  FOREIGN KEY (zona, indirizzo) REFERENCES zona(nome, indirizzo)

);

CREATE TABLE ord_part (
  codo          int             NOT NULL,
  code          int             NOT NULL,
  data_evento   datetime        NOT NULL,
  zona          varchar(20)     NOT NULL,
  indirizzo     varchar(40)     NOT NULL,
  prezzo        int             NOT NULL,

  PRIMARY KEY (codo, code, zona),
  FOREIGN KEY (codo) REFERENCES ordine(codo),
  FOREIGN KEY (code, data_evento, zona, indirizzo) REFERENCES partecipazione(code, data_evento, zona, indirizzo)
);

CREATE TABLE evento_spec_mirror (
  nome          varchar(40)     NOT NULL,
  code          int             NOT NULL,
  data_evento   datetime        NOT NULL,
  indirizzo     varchar(40)     NOT NULL,
  tipo          varchar(10)     NOT NULL,
  casa          varchar(20)     NULL,
  ospite        varchar(20)     NULL,
  compagnia     varchar(20)     NULL,
  artista       varchar(20)     NULL,

  PRIMARY KEY (code, data_evento),
  FULLTEXT (nome)
  
);
ALTER TABLE evento_spec_mirror ENGINE = MyISAM;


INSERT INTO utente_r VALUES('admin@ticketstore.it',md5('password'),'admin'); 
INSERT INTO evento_spec_mirror
VALUES ('derby',1,'2018-05-29 21:00:00','Milano, San Siro','Partita','Inter','Milan',NULL,NULL);

INSERT INTO evento (nome, path_img, nome_img) VALUES ('derby','.\\View\\imgs','derbymilano.jpg');
INSERT INTO luogo VALUES ('Milano, San Siro');
INSERT INTO evento_spec
VALUES (1,'2018-05-29 21:00:00','Milano, San Siro','Partita','Inter','Milan',NULL,NULL);
INSERT INTO zona 
VALUES ('curva','Milano, San Siro',50);
INSERT INTO partecipazione
VALUES (1,'2018-05-29 21:00:00','curva','Milano, San Siro',40);