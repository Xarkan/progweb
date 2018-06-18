DROP DATABASE IF EXISTS DB_biglietti;
CREATE DATABASE DB_biglietti;
USE DB_biglietti;


CREATE TABLE evento (
  code          varchar(20)     NOT NULL,
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
  data_ordine    date        	NOT NULL,
 
  PRIMARY KEY (codo)

);

CREATE TABLE luogo (
  indirizzo     varchar(40)     NOT NULL,
  struttura     varchar(40)     NOT NULL,

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
  code          varchar(20)     NOT NULL,
  data_evento   date            NOT NULL,
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
  code          varchar(40)     NOT NULL,
  data_evento   date            NOT NULL,
  zona          varchar(20)     NOT NULL,
  indirizzo     varchar(40)     NOT NULL,
  prezzo        int             NOT NULL,

  PRIMARY KEY (code, data_evento, zona, indirizzo),
  FOREIGN KEY (code, data_evento) REFERENCES evento_spec(code, data_evento),
  FOREIGN KEY (zona, indirizzo) REFERENCES  zona(nome, indirizzo)
);

CREATE TABLE biglietto (
  codb          int             NOT NULL    AUTO_INCREMENT,
  code          varchar(20)     NOT NULL,
  codo          int	        NULL,
  mail          varchar(40)     NULL,
  evento        varchar(40)     NOT NULL,
  data_evento   date        	NOT NULL,
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
  code          varchar(40)     NOT NULL,
  data_evento   date            NOT NULL,
  zona          varchar(20)     NOT NULL,
  indirizzo     varchar(40)     NOT NULL,
  prezzo        int             NOT NULL,

  PRIMARY KEY (codo, code, zona),
  FOREIGN KEY (codo) REFERENCES ordine(codo),
  FOREIGN KEY (code, data_evento, zona, indirizzo) REFERENCES partecipazione(code, data_evento, zona, indirizzo)
);

----------------------------------------INSERT evento-----------------------------------------------------------

INSERT INTO evento
VALUES ('evento0','derby','.\\View\\imgs','derbymilano.jpg');
INSERT INTO evento
VALUES ('evento1','derby Romano','.\\View\\imgs','romalazio.jpg');
INSERT INTO evento
VALUES ('evento2','Deep Purple','.\\View\\imgs','Deep.jpg');
INSERT INTO evento
VALUES ('evento3','Pinocchio','.\\View\\imgs','pinocchio-musical.jpg');
INSERT INTO evento
VALUES ('evento4','Vasco Rossi','.\\View\\imgs','vascorossi.jpg');
INSERT INTO evento
VALUES ('evento5','Real Madrid-Barcellona','.\\View\\imgs','realbarca.jpg');
------------------------------------------INSERT utente_r-------------------------------------------------------
INSERT INTO utente_r
VALUES ('admin@ticketstore.it',md5('password'),'Mago Santucci');
INSERT INTO utente_r
VALUES ('edgardovittoria@hotmail.it',md5('pippo'),'Edgardo Vittoria');
INSERT INTO utente_r
VALUES ('federicoraparelli@hotmail.it',md5('pluto'),'Federico Raparelli');
INSERT INTO utente_r
VALUES ('pier@hotmail.it',md5('ciao'),'Pierluca Masiello');
INSERT INTO utente_r
VALUES ('paolino@hotmail.it',md5('database'),'Paolino Di Felice');

--------------------------------------------INSERT ordine---------------------------------------------------------

INSERT INTO ordine (mail,data_ordine)
VALUES ('edgardovittoria@hotmail.it','2018-05-10');
INSERT INTO ordine (mail,data_ordine)
VALUES ('federicoraparelli@hotmail.it','2018-05-01');
INSERT INTO ordine (mail,data_ordine)
VALUES ('pier@hotmail.it','2018-04-10');
INSERT INTO ordine (mail,data_ordine)
VALUES ('paolino@hotmail.it','2018-12-05');


------------------------------------------------INSERT luogo-----------------------------------------------------

INSERT INTO luogo
VALUES ('Milano, Sansiro','stadio Giuseppe Meazza');
INSERT INTO luogo
VALUES ('Roma, Olimpico','stadio Olimpico');
INSERT INTO luogo
VALUES ('Londra, via x','stadio Wembley');
INSERT INTO luogo
VALUES ('Roma, via Appia Antica','teatro Brancaccio');

--------------------------------------------------INSERT zona-----------------------------------------------------

INSERT INTO zona 
VALUES ('curva','Milano, Sansiro',50);
INSERT INTO zona 
VALUES ('prato','Milano, Sansiro',10);
INSERT INTO zona 
VALUES ('tribuna','Roma, Olimpico',30);
INSERT INTO zona 
VALUES ('prato','Roma, Olimpico',10);
INSERT INTO zona 
VALUES ('prato','Londra, via x',20);
INSERT INTO zona 
VALUES ('curva','Londra, via x',50);
INSERT INTO zona 
VALUES ('galleria','Roma, via Appia Antica',10);
INSERT INTO zona 
VALUES ('platea','Roma, via Appia Antica',20);

------------------------------------------------------INSERT evento_spec-----------------------------------------

INSERT INTO evento_spec
VALUES ('evento0','2018-05-29','Milano, Sansiro','Partita','Inter','Milan',NULL,NULL);
INSERT INTO evento_spec
VALUES ('evento1','2018-05-12','Roma, Olimpico','Partita','Roma','Lazio',NULL,NULL);
INSERT INTO evento_spec
VALUES ('evento2','2018-05-30','Londra, via x','Concerto',NULL,NULL,NULL,'Deep Purple');
INSERT INTO evento_spec
VALUES ('evento2','2018-06-15','Milano, Sansiro','Concerto',NULL,NULL,NULL,'Deep Purple');
INSERT INTO evento_spec
VALUES ('evento2','2018-06-30','Roma, Olimpico','Concerto',NULL,NULL,NULL,'Deep Purple');
INSERT INTO evento_spec
VALUES ('evento3','2019-05-21','Roma, via Appia Antica','Spettacolo',NULL,NULL,'EmmeBi',NULL);
INSERT INTO evento_spec
VALUES ('evento4','2019-06-30','Roma, Olimpico','Concerto',NULL,NULL,NULL,'Vasco Rossi');
INSERT INTO evento_spec
VALUES ('evento5','2018-06-2','Milano, Sansiro','Partita','Real Madrid','Barcellona',NULL,NULL);


----------------------------------------------INSERT biglietto-----------------------------------------------------

INSERT INTO biglietto (code, codo, mail, evento, data_evento, zona, indirizzo, fila, posto)
VALUES ('evento0',1,'edgardovittoria@hotmail.it','derby','2018-05-29','curva','Milano, Sansiro',10,56);
INSERT INTO biglietto (code, codo, mail, evento, data_evento, zona, indirizzo, fila, posto)
VALUES ('evento1',2,'federicoraparelli@hotmail.it','derby Romano','2018-05-12','tribuna','Roma, Olimpico',15,86);
INSERT INTO biglietto (code, codo, mail, evento, data_evento, zona, indirizzo, fila, posto)
VALUES ('evento2',3,'pier@hotmail.it','Deep Purple','2018-05-30','prato','Londra, via x',NULL,NULL);
INSERT INTO biglietto (code, codo, mail, evento, data_evento, zona, indirizzo, fila, posto)
VALUES ('evento3',4,'paolino@hotmail.it','Pinocchio','2019-05-21','galleria','Roma, via Appia Antica',3,5);
INSERT INTO biglietto (code, codo, mail, evento, data_evento, zona, indirizzo, fila, posto)
VALUES ('evento3',4,'paolino@hotmail.it','Pinocchio','2019-05-21','galleria','Roma, via Appia Antica',3,6);
INSERT INTO biglietto (code, codo, mail, evento, data_evento, zona, indirizzo, fila, posto)
VALUES ('evento3',4,'paolino@hotmail.it','Pinocchio','2019-05-21','galleria','Roma, via Appia Antica',3,7);
INSERT INTO biglietto (code, codo, mail, evento, data_evento, zona, indirizzo, fila, posto)
VALUES ('evento3',4,'paolino@hotmail.it','Pinocchio','2019-05-21','galleria','Roma, via Appia Antica',3,8);
INSERT INTO biglietto (code, evento, data_evento, zona, indirizzo)
VALUES ('evento0','derby','2018-05-29','curva','Milano, Sansiro');
-----------------------------------------------------INSERT partecipazione----------------------------------------

INSERT INTO partecipazione
VALUES ('evento0','2018-05-29','curva','Milano, Sansiro',40);
INSERT INTO partecipazione
VALUES ('evento2','2018-06-15','prato','Milano, Sansiro',100);
INSERT INTO partecipazione
VALUES ('evento1','2018-05-12','tribuna','Roma, Olimpico',70);
INSERT INTO partecipazione
VALUES ('evento2','2018-06-30','prato','Roma, Olimpico',100);
INSERT INTO partecipazione
VALUES ('evento2','2018-05-30','prato','Londra, via x',100);
INSERT INTO partecipazione
VALUES ('evento2','2018-05-30','curva','Londra, via x',80);
INSERT INTO partecipazione
VALUES ('evento3','2019-05-21','galleria','Roma, via Appia Antica',89);
INSERT INTO partecipazione
VALUES ('evento4','2019-06-30','prato','Roma, Olimpico',100);
INSERT INTO partecipazione
VALUES ('evento5','2018-06-2','curva','Milano, Sansiro',40);
------------------------------------------------------INSERT ord_part----------------------------------------------

INSERT INTO ord_part
VALUES (1,'evento0','2018-05-29','curva','Milano, Sansiro',40);
INSERT INTO ord_part
VALUES (2,'evento1','2018-05-12','tribuna','Roma, Olimpico',70);
INSERT INTO ord_part
VALUES (3,'evento2','2018-05-30','prato','Londra, via x',100);
INSERT INTO ord_part
VALUES (4,'evento3','2019-05-21','galleria','Roma, via Appia Antica',89);