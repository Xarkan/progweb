
DROP DATABASE IF EXISTS DB_biglietti;
CREATE DATABASE DB_biglietti;
USE DB_biglietti;

CREATE TABLE evento (
  cod_evento    varchar(10)     NOT NULL,
  nome          varchar(20)     NOT NULL,
  luogo         varchar(40)     NOT NULL,
  data_evento   date            NOT NULL,
  descrizione   varchar(500)    NOT NULL,
  PRIMARY KEY(cod_evento)
  
);
INSERT INTO evento VALUES("0", "derby", "milano", 15/2/1994, "vafvsebgksbiugbseiu");
CREATE TABLE utente_r (
  mail          varchar(20)     NOT NULL,
  psw           varchar(16)     NOT NULL,
  nome          varchar(20)     NOT NULL,
  cognome       varchar(20)     NOT NULL,
  PRIMARY KEY(mail)
);

CREATE TABLE ordine (
  id            varchar(10)     NOT NULL,
  mail          varchar(40)     NOT NULL,
  data_ordine   date            NOT NULL,
  prezzo        float           NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (mail) REFERENCES utente_r(mail)
);

CREATE TABLE ordine_biglietto (
  id_ord        varchar(10)     NOT NULL,
  cod_bigl      varchar(10)     NOT NULL,
  cod_evento    varchar(10)     NOT NULL,
  PRIMARY KEY (id_ord,cod_bigl,cod_evento),
  FOREIGN KEY (id_ord) REFERENCES ordine(id),
  FOREIGN KEY(cod_evento) REFERENCES evento(cod_evento) 
);

CREATE TABLE biglietti (
  codice        varchar(10)     NOT NULL,
  cod_evento    varchar(10)     NOT NULL,
  utente        varchar(40)     NOT NULL,
  zona          varchar(20)     NOT NULL,
  posto         int             NOT NULL,
  PRIMARY KEY(codice,cod_evento),
  FOREIGN KEY(cod_evento) REFERENCES evento(cod_evento)
);

CREATE TABLE luogo (
  citta         varchar(20)     NOT NULL,
  via           varchar(20)     NOT NULL,
  cod_evento    varchar(10)     NOT NULL,
  struttura     varchar(20)     NOT NULL,
  PRIMARY KEY(citta,via,cod_evento),
  FOREIGN KEY(cod_evento) REFERENCES evento(cod_evento)
);

CREATE TABLE biglietti_zona (
  zona          varchar(20)     NOT NULL,
  cod_evento    varchar(10)     NOT NULL,
  prezzo        float           NOT NULL,
  PRIMARY KEY(zona,cod_evento),
  FOREIGN KEY(cod_evento) REFERENCES evento(cod_evento)
);

CREATE TABLE dettaglio_evento (
  cod_evento    varchar(10)     NOT NULL,
  tipo          varchar(10)     NOT NULL,
  artista       varchar(20)     NULL,
  compagnia     varchar(20)     NULL,
  casa          varchar(20)     NULL,
  ospite        varchar(20)     NULL,
  PRIMARY KEY(cod_evento),
  FOREIGN KEY(cod_evento) REFERENCES evento(cod_evento)
);