
DROP DATABASE IF EXISTS DB_biglietti;
CREATE DATABASE DB_biglietti;
USE DB_biglietti;

CREATE TABLE evento (
  cod_evento    varchar(10)     NOT NULL,
  data_evento   varchar(40)     NOT NULL,
  nome          varchar(20)     NOT NULL,
  citta         varchar(40)     NOT NULL,
  struttura     varchar(40)     NOT NULL,
  via           varchar(40)     NOT NULL,
  descrizione   varchar(500)    NOT NULL,
  PRIMARY KEY(cod_evento,data_evento)
  
);

/*CREATE TABLE immagini (
    id          int(11)         NOT NULL    auto_increment,
    cod_evento  varchar(10)     NOT NULL,
    data_evento varchar(40)     NOT NULL,
    nome        varchar(50)     NOT NULL    default "",
    size        varchar(25)     NOT NULL    default "",
    type        varchar(25)     NOT NULL    default "",
    immagine    blob            NOT NULL,
    PRIMARY KEY (id,cod_evento,data_evento)    
    FOREIGN KEY(cod_evento,data_evento) REFERENCES evento(cod_evento,data_evento)
);*/

CREATE TABLE utente_r (
  mail          varchar(20)     NOT NULL,
  psw           varchar(16)     NOT NULL,
  nome          varchar(40)     NOT NULL,
  PRIMARY KEY(mail)
);

CREATE TABLE ordine (
  id            varchar(10)     NOT NULL,
  mail          varchar(40)     NOT NULL,
  data_ordine   varchar(40)     NOT NULL,
  prezzo        float           NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (mail) REFERENCES utente_r(mail)
);

CREATE TABLE ordine_biglietto (
  id_ord        varchar(10)     NOT NULL,
  cod_bigl      varchar(10)     NOT NULL,
  cod_evento    varchar(10)     NOT NULL,
  data_evento   varchar(40)     NOT NULL,
  PRIMARY KEY (id_ord,cod_bigl,cod_evento,data_evento),
  FOREIGN KEY (id_ord) REFERENCES ordine(id),
  FOREIGN KEY(cod_evento,data_evento) REFERENCES evento(cod_evento,data_evento) 
);

CREATE TABLE biglietti (
  cod_evento    varchar(10)     NOT NULL,
  data_evento   varchar(40)     NOT NULL,
  codice        varchar(10)     NOT NULL,
  utente        varchar(40)     NULL,
  zona          varchar(20)     NOT NULL,
  posto         int             NOT NULL,
  PRIMARY KEY(codice,cod_evento,data_evento),
  FOREIGN KEY(cod_evento,data_evento) REFERENCES evento(cod_evento,data_evento)
);

CREATE TABLE biglietti_zona (
  cod_evento    varchar(10)     NOT NULL,
  data_evento   varchar(40)     NOT NULL,
  zona          varchar(20)     NOT NULL,
  prezzo        float           NOT NULL,
  PRIMARY KEY(cod_evento,data_evento,zona),
  FOREIGN KEY(cod_evento,data_evento) REFERENCES evento(cod_evento,data_evento)
);

CREATE TABLE dettaglio_evento (
  cod_evento    varchar(10)     NOT NULL,
  data_evento   varchar(40)     NOT NULL,
  tipo          varchar(10)     NOT NULL,
  artista       varchar(20)     NULL,
  compagnia     varchar(20)     NULL,
  casa          varchar(20)     NULL,
  ospite        varchar(20)     NULL,
  PRIMARY KEY(cod_evento,data_evento),
  FOREIGN KEY(cod_evento,data_evento) REFERENCES evento(cod_evento,data_evento)
);

--insert evento
INSERT INTO evento VALUES("0","19/4/2018-22:53", "derby", "Milano","San Siro","via abc",  "abc");
INSERT INTO evento VALUES("0","30/4/2018-22:53", "derby", "Milano","San Siro","via abc",  "descrizion0");
INSERT INTO evento VALUES("1","22/5/2018-21:00", "Amleto", "L'Aquila"," Ridotto","via def",  "descrizione1");
INSERT INTO evento VALUES("1","28/5/2018-21:00", "Amleto", "L'Aquila"," Ridotto","via def",  "descrizione1");
INSERT INTO evento VALUES("2","8/7/2018-23:00", "Live concert", "Roma","Parco","via boh",  "descrizione2");
INSERT INTO evento VALUES("3","7/5/2019-22:00","Cyrano de Bergerac","Pizzo Calabro","SkyLab","via Washington","sdsjadh");
INSERT INTO evento VALUES("3","9/5/2019-22:00","Cyrano de Bergerac","Pizzo Calabro","SkyLab","via Washington","sdsjaqdgh");
INSERT INTO evento VALUES("4","14/7/2019-21:00","Roma-Napoli","Roma","via croce","Olimpico","sdkjsdjh");
INSERT INTO evento VALUES("4","31/9/2019-21:00","Roma-Napoli","Roma","via croce","Olimpico","sdkjsdjh");

--insert biglietti_zona
INSERT INTO biglietti_zona VALUES("1","22/5/2018-21:00","platea",13);
INSERT INTO biglietti_zona VALUES("1","22/5/2018-21:00","galleria",11);
INSERT INTO biglietti_zona VALUES("0","19/4/2018-22:53","curva",40);
INSERT INTO biglietti_zona VALUES("0","30/4/2018-22:53","tribuna",45);
INSERT INTO biglietti_zona VALUES("2","8/7/2018-23:00","prato",21);
INSERT INTO biglietti_zona VALUES("2","8/7/2018-23:00","spalti",18);

--insert utente_r
INSERT INTO utente_r VALUES("tizio@gmail.com","pippo","Tizio Caio");
INSERT INTO utente_r VALUES("pinco@hotmail.it","papero","Pinco Pallino");

--insert biglietti
INSERT INTO biglietti VALUES("1","22/5/2018-21:00", "B0", NULL, "galleria", 3);
INSERT INTO biglietti VALUES("1","22/5/2018-21:00", "B1", "edgardo vittoria", "galleria", 2);
INSERT INTO biglietti VALUES("1","22/5/2018-21:00", "B2", NULL, "platea", 5);
INSERT INTO biglietti VALUES("0","19/4/2018-22:53", "A0", NULL, "curva", 7);
INSERT INTO biglietti VALUES("0","30/4/2018-22:53", "A1", NULL, "tribuna", 24);
INSERT INTO biglietti VALUES("0","30/4/2018-22:53", "A2", NULL, "tribuna", 15);
INSERT INTO biglietti VALUES("2","8/7/2018-23:00", "C0", "federico raparelli", "prato", 43);
INSERT INTO biglietti VALUES("2","8/7/2018-23:00", "C1", NULL, "prato", 52);

INSERT INTO dettaglio_evento VALUES("0","19/4/2018-22:53", "Partita", NULL,NULL,"Inter","Milan");
INSERT INTO dettaglio_evento VALUES("0","30/4/2018-22:53", "Partita", NULL,NULL,"Inter","Milan");
INSERT INTO dettaglio_evento VALUES("1","22/5/2018-21:00", "Spettacolo", NULL," emmeb",NULL,NULL);
INSERT INTO dettaglio_evento VALUES("1","28/5/2018-21:00", "Spettacolo", NULL," emmeb",NULL,NULL);
INSERT INTO dettaglio_evento VALUES("2","8/7/2018-23:00","Concerto","Dream Theater",NULL,NULL,NULL);
INSERT INTO dettaglio_evento VALUES("3","7/5/2019-22:00","Spettacolo", NULL,"AGG",NULL,NULL);
INSERT INTO dettaglio_evento VALUES("3","9/5/2019-22:00","Spettacolo", NULL,"AGG",NULL,NULL);
INSERT INTO dettaglio_evento VALUES("4","14/7/2019-21:00","Partita",NULL,NULL,"Roma","Napoli");
INSERT INTO dettaglio_evento VALUES("4","31/9/2019-21:00","Partita",NULL,NULL,"Napoli","Roma");
--INSERT INTO dettagli_evento VALUES("2","8/7/2018-23:00", "Live concert", "Roma","Parco","via boh",  "descrizione2");

 