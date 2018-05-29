DROP DATABASE IF EXISTS DB_biglietti;
CREATE DATABASE DB_biglietti;
USE DB_biglietti;


CREATE TABLE evento (
  code          varchar(10)     NOT NULL,
  nome          varchar(20)     NOT NULL,

  PRIMARY KEY(code)
  
);

CREATE TABLE utente_r (
  mail          varchar(20)     NOT NULL,
  psw           varchar(16)     NOT NULL,
  nome          varchar(40)     NOT NULL,
  PRIMARY KEY(mail)
);

CREATE TABLE ordine (
  codo           int     	      NOT NULL,
  mail           varchar(40)    NOT NULL,
  data_ordine    date        	  NOT NULL,
 
  PRIMARY KEY (codo)

);

CREATE TABLE biglietto (
  codb          varchar(10)     NOT NULL,
  codo          int	            NOT NULL,
  mail          varchar(40)     NOT NULL,
  evento        varchar(40)     NOT NULL,
  data_evento   date        	  NOT NULL,
  zona          varchar(20)     NOT NULL,
  fila          int             NULL,
  posto         int             NULL,
  PRIMARY KEY(codb),
  FOREIGN KEY(codo) REFERENCES ordine(codo),
  FOREIGN KEY(mail) REFERENCES utente_r(mail)

);

CREATE TABLE luogo (
  indirizzo     varchar(40)     NOT NULL,
  struttura     varchar(20)     NOT NULL,

  PRIMARY KEY (indirizzo)
);

CREATE TABLE zona (
  nome          varchar(20)     NOT NULL,
  indirizzo     varchar(40)     NOT NULL,
  capacita      int             NOT NULL,
  fila          int             NOT NULL,
  posto         int             NOT NULL,

  PRIMARY KEY (nome, indirizzo),
  FOREIGN KEY (indirizzo) REFERENCES luogo(indirizzo)
);

CREATE TABLE partecipazione (
  zona          varchar(20)     NOT NULL,
  indirizzo     varchar(40)     NOT NULL,
  prezzo        int             NOT NULL,

  PRIMARY KEY (zona, indirizzo, prezzo),
  FOREIGN KEY (zona, indirizzo) REFERENCES  zona(nome, indirizzo)
);

CREATE TABLE ord_part (
  codo          int             NOT NULL,
  zona          varchar(20)     NOT NULL,
  indirizzo     varchar(40)     NOT NULL,
  prezzo        int             NOT NULL,

  PRIMARY KEY (codo, zona, indirizzo, prezzo),
  FOREIGN KEY (codo) REFERENCES ordine(codo),
  FOREIGN KEY (zona, indirizzo, prezzo) REFERENCES partecipazione(zona, indirizzo, prezzo)
);

CREATE TABLE evento_spec (
  code          varchar(10)     NOT NULL,
  data_evento   date            NOT NULL,
  indirizzo     varchar(40)     NOT NULL,
  zona          varchar(20)     NOT NULL,
  prezzo        int             NOT NULL,
  tipo          varchar(10)     NOT NULL,
  casa          varchar(20)     NULL,
  ospite        varchar(20)     NULL,
  compagnia     varchar(20)     NULL,
  artista       varchar(20)     NULL,

  PRIMARY KEY (code, dataS_evento, indirizzo),
  FOREIGN KEY (code) REFERENCES evento(code),
  FOREIGN KEY (zona, indirizzo, prezzo) REFERENCES partecipazione(zona, indirizzo, prezzo)
);  