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


INSERT INTO evento (nome, path_img, nome_img) VALUES
('derby', '.\\View\\imgs', 'derbymilano.jpg'),
('derbyromano', '.\\View\\imgs', 'romalazio.jpg'),
('pinocchio', '.\\View\\imgs', 'pinocchio-musical.jpg'),
('Real-Barca', '.\\View\\imgs', 'realbarca.jpg'),
('deep purple', '.\\View\\imgs', 'Deep.jpg'),
('enrico brignano', '.\\View\\imgs', 'enricobrignano.jpg'),
('Gigi Proietti', '.\\View\\imgs', 'gigiproietti.gif'),
('ligabue', '.\\View\\imgs', 'ligabue.jpg'),
('romeo e giulietta', '.\\View\\imgs', 'romeoegiulietta.jpg');

INSERT INTO luogo (indirizzo) VALUES
('Bari, San Nicola'),
('L\'Aquila, teatro comunale'),
('Londra, Wembley'),
('Madrid, Bernabeu'),
('Milano, San Siro'),
('Milano, Scala'),
('Palena, Teatro Comunale'),
('Roma, Brancaccio'),
('Roma, Olimpico');


INSERT INTO evento_spec (code, data_evento, indirizzo, tipo, casa, ospite, compagnia, artista) VALUES
(1, '2018-05-29 21:00:00', 'Milano, San Siro', 'Partita', 'Inter', 'Milan', NULL, NULL),
(2, '2018-06-20 20:00:00', 'Roma, Olimpico', 'Partita', 'Lazio', 'Roma', NULL, NULL),
(3, '2018-06-20 20:00:00', 'L\'Aquila, teatro comunale', 'Spettacolo', NULL, NULL, 'emmebi', NULL),
(4, '2018-06-20 20:00:00', 'Madrid, Bernabeu', 'Partita', 'Real Madrid', 'Barcellona', '', ''),
(5, '2018-06-20 20:00:00', 'Londra, Wembley', 'Concerto', NULL, NULL, NULL, 'Deep Purple'),
(6, '2018-06-20 20:00:00', 'Roma, Brancaccio', 'Spettacolo',NULL, NULL, 'Enrico Brignano',NULL),
(7, '2018-06-20 20:00:00', 'Milano, Scala', 'Spettacolo',NULL, NULL, 'Gigi Proietti', NULL),
(8, '2018-06-20 20:00:00', 'Bari, San Nicola', 'Concerto', NULL, NULL, NULL, 'Luciano Ligabue'),
(9, '2018-06-20 20:00:00', 'Palena, Teatro Comunale', 'Spettacolo', NULL, NULL, 'emmebi',NULL);

INSERT INTO evento_spec_mirror (nome, code, data_evento, indirizzo, tipo, casa, ospite, compagnia, artista) VALUES
('derby', 1, '2018-05-29 21:00:00', 'Milano, San Siro', 'Partita', 'Inter', 'Milan', NULL, NULL),
('derbyromano', 2, '2018-06-20 20:00:00', 'Roma, Olimpico', 'Partita', 'Lazio', 'Roma', '', ''),
('pinocchio', 3, '2018-06-20 20:00:00', 'L\'Aquila, teatro comunale', 'Spettacolo', '', '', 'emmebi', ''),
('Real-Barca', 4, '2018-06-20 20:00:00', 'Madrid, Bernabeu', 'Partita', 'Real Madrid', 'Barcellona', '', ''),
('deep purple', 5, '2018-06-20 20:00:00', 'Londra, Wembley', 'Concerto', '', '', '', 'Deep Purple'),
('enrico brignano', 6, '2018-06-20 20:00:00', 'Roma, Brancaccio', 'Spettacolo', '', '', 'Enrico Brignano', ''),
('Gigi Proietti', 7, '2018-06-20 20:00:00', 'Milano, Scala', 'Spettacolo', '', '', 'Gigi Proietti', ''),
('ligabue', 8, '2018-06-20 20:00:00', 'Bari, San Nicola', 'Concerto', '', '', '', 'Luciano Ligabue'),
('romeo e giulietta', 9, '2018-06-20 20:00:00', 'Palena, Teatro Comunale', 'Spettacolo', '', '', 'emmebi', '');

INSERT INTO zona (nome, indirizzo, capacita) VALUES
('curva', 'Bari, San Nicola', 40),
('curva', 'Milano, San Siro', 50),
('spalti', 'Milano, San Siro', 60),
('curva', 'Roma, Olimpico', 50),
('galleria', 'L\'Aquila, teatro comunale', 50),
('galleria', 'Milano, Scala', 14),
('platea', 'Roma, Brancaccio', 20),
('prato', 'Londra, Wembley', 100),
('tribuna', 'Madrid, Bernabeu', 100),
('platea','Palena, teatro comunale',2);

INSERT INTO biglietto (code, evento, data_evento, zona, indirizzo) VALUES
(1,'derby','2018-05-29 21:00:00', 'curva', 'Milano, San Siro');
INSERT INTO biglietto (code, evento, data_evento, zona, indirizzo) VALUES
(1,'derby','2018-05-29 21:00:00', 'curva', 'Milano, San Siro');
INSERT INTO biglietto (code, evento, data_evento, zona, indirizzo) VALUES
(1,'derby','2018-05-29 21:00:00', 'curva', 'Milano, San Siro');
INSERT INTO biglietto (code, evento, data_evento, zona, indirizzo) VALUES
(1,'derby','2018-05-29 21:00:00', 'curva', 'Milano, San Siro');
INSERT INTO biglietto (code, evento, data_evento, zona, indirizzo) VALUES
(1,'derby','2018-05-29 21:00:00', 'curva', 'Milano, San Siro');
INSERT INTO biglietto (code, evento, data_evento, zona, indirizzo) VALUES
(1,'derby','2018-05-29 21:00:00', 'curva', 'Milano, San Siro');
INSERT INTO biglietto (code, evento, data_evento, zona, indirizzo) VALUES
(1,'derby','2018-05-29 21:00:00', 'curva', 'Milano, San Siro');
INSERT INTO biglietto (code, evento, data_evento, zona, indirizzo) VALUES
(1,'derby','2018-05-29 21:00:00', 'curva', 'Milano, San Siro');
INSERT INTO biglietto (code, evento, data_evento, zona, indirizzo) VALUES
(1,'derby','2018-05-29 21:00:00', 'curva', 'Milano, San Siro');
INSERT INTO biglietto (code, evento, data_evento, zona, indirizzo) VALUES
(1,'derby','2018-05-29 21:00:00', 'curva', 'Milano, San Siro');

INSERT INTO biglietto (code, evento, data_evento, zona, indirizzo) VALUES
(2,'derbyromano', '2018-06-20 20:00:00', 'curva', 'Roma, Olimpico');
INSERT INTO biglietto (code, evento, data_evento, zona, indirizzo) VALUES
(2,'derbyromano', '2018-06-20 20:00:00', 'curva', 'Roma, Olimpico');

INSERT INTO partecipazione (code, data_evento, zona, indirizzo, prezzo) VALUES
(1, '2018-05-29 21:00:00', 'curva', 'Milano, San Siro', 40),
(1, '2018-05-29 21:00:00', 'spalti', 'Milano, San Siro', 50),
(2, '2018-06-20 20:00:00', 'curva', 'Roma, Olimpico', 50),
(3, '2018-06-20 20:00:00', 'galleria', 'L\'Aquila, teatro comunale', 100),
(4, '2018-06-20 20:00:00', 'tribuna', 'Madrid, Bernabeu', 100),
(5, '2018-06-20 20:00:00', 'prato', 'Londra, Wembley', 150),
(6, '2018-06-20 20:00:00', 'platea', 'Roma, Brancaccio', 70),
(7, '2018-06-20 20:00:00', 'galleria', 'Milano, Scala', 60),
(8, '2018-06-20 20:00:00', 'curva', 'Bari, San Nicola', 30),
(9, '2018-06-20 20:00:00', 'platea','Palena, teatro comunale',2);

