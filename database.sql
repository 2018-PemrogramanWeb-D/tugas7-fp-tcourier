create database tcourier;
 
use tcourier;
 
CREATE TABLE `users` (
  `nrp` char(14) NOT NULL,
  `email` varchar(100),
  `pwd` varchar(20)NOT NULL,
  `nohp` varchar(15),
  `idline` varchar(15),
  PRIMARY KEY  (`nrp`)
);