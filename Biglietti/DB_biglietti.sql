
DROP DATABASE IF EXISTS DB_biglietti;
CREATE DATABASE DB_biglietti;
USE DB_biglietti;

CREATE TABLE evento (
  cod_evento    varchar(10)     NOT NULL,
  nome          varchar(20)     NOT NULL,
  luogo         varchar(40)     NOT NULL,
  data_evento   varchar(40)     NOT NULL,
  descrizione   varchar(500)    NOT NULL,
  PRIMARY KEY(cod_evento)
  
);

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
  utente        varchar(40)     NULL,
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

--insert evento
INSERT INTO evento VALUES("0", "derby", "Milano;San Siro;via abc", "19/4/2018-22:53", "descrizion0");
INSERT INTO evento VALUES("1", "Ridotto", "L'Aquila; Ridotto;via def", "22/5/2018-21:00", "descrizione1");
INSERT INTO evento VALUES("2", "Live concert", "Roma;Parco;via boh", "8/7/2018-23:00", "descrizione2");

--insert biglietti_zona
INSERT INTO biglietti_zona VALUES("platea","1",13);
INSERT INTO biglietti_zona VALUES("galleria","1",11);
INSERT INTO biglietti_zona VALUES("curva","0",40);
INSERT INTO biglietti_zona VALUES("tribuna","0",45);
INSERT INTO biglietti_zona VALUES("prato","2",21);
INSERT INTO biglietti_zona VALUES("spalti","2",18);

--insert utente_r
INSERT INTO utente_r VALUES("tizio@gmail.com","pippo","Tizio","Caio");
INSERT INTO utente_r VALUES("pinco@hotmail.it","papero","Pinco","Pallino");

--insert biglietti
INSERT INTO biglietti VALUES("1", "B0", NULL, "galleria", 3);
INSERT INTO biglietti VALUES("1", "B1", "edgardo vittoria", "galleria", 2);
INSERT INTO biglietti VALUES("1", "B2", NULL, "platea", 5);
INSERT INTO biglietti VALUES("0", "A0", NULL, "curva", 7);
INSERT INTO biglietti VALUES("0", "A1", NULL, "tribuna", 24);
INSERT INTO biglietti VALUES("0", "A2", NULL, "tribuna", 15);
INSERT INTO biglietti VALUES("2", "C0", "federico raparelli", "prato", 43);
INSERT INTO biglietti VALUES("2", "C1", NULL, "prato", 52);

 