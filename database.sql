create database tcourier;
 
use tcourier;
 
CREATE TABLE `users` (
  `nrp` char(14) NOT NULL,
  `nama` varchar(50),
  `email` varchar(100),
  `pwd` varchar(20) NOT NULL,
  `nohp` varchar(15),
  `idline` varchar(15),
  PRIMARY KEY  (`nrp`)
);


CREATE TABLE `wilayah`(
	`id_wilayah` int (2) NOT NULL auto_increment,
	`nama_wilayah` varchar (10) NOT NULL,
	`ongkos_wilayah` INT (255) NOT NULL,
 	PRIMARY KEY (`id_wilayah`)
);

CREATE TABLE `makanan`(
	`id_makanan` int (3) NOT NULL auto_increment,
	`nama_makanan` varchar (100) NOT NULL,
	`wilayah_makanan` int (2) NOT NULL,
	`harga_makanan` integer (255) NOT NULL,
	`deskripsi_makanan` varchar(100),
	PRIMARY KEY(`id_makanan`),
	FOREIGN KEY (`wilayah_makanan`) REFERENCES wilayah(`id_wilayah`)
);

CREATE TABLE `customer`(
	`nrp_customer` char(14) NOT NULL,
	FOREIGN KEY (`nrp_customer`) REFERENCES users(`nrp`),
	PRIMARY KEY  (`nrp_customer`)
	
);

CREATE TABLE `pesanan`(
	`id_pesanan` int (5) NOT NULL auto_increment,
	`nrp_pemesan` char (14) NOT NULL,
 	PRIMARY KEY (`id_pesanan`),
 	FOREIGN KEY (`nrp_pemesan`) REFERENCES users(`nrp`)
);

CREATE TABLE `list_pesanan`(
	`id_list` int (5) NOT NULL auto_increment,
	`id_pesanan` int (5) NOT NULL,
	`id_makanan` int (3) NOT NULL,
	`jumlah` int (2) NOT NULL,
	PRIMARY KEY (`id_list`),
	FOREIGN KEY (`id_pesanan`) REFERENCES pesanan(`id_pesanan`),
	FOREIGN KEY (`id_makanan`) REFERENCES makanan(`id_makanan`)
);


CREATE TABLE `courier`(
	`nrp_courier` char(14) NOT NULL,
	`wilayah_courier` int(2) NOT NULL,
	`pesanan_courier` int(5),
	PRIMARY KEY  (`nrp_courier`),
	FOREIGN KEY (`wilayah_courier`) REFERENCES wilayah(`id_wilayah`),
	FOREIGN KEY (`pesanan_courier`) REFERENCES pesanan(`id_pesanan`),
	FOREIGN KEY (`nrp_courier`) REFERENCES users(`nrp`)
);

-- CREATE TABLE `nota_pesanan` (
-- 	`id_nota` char(5) NOT NULL,
-- 	`nota_customer` char(14) NOT NULL,
-- 	`nota_courier` char(14) NOT NULL,
-- 	`total_bayar` int 25,
-- 	FOREIGN KEY (`id_nota`) REFERENCES pesanan(`id_pesanan`),
-- 	PRIMARY KEY(`id_nota`),
-- 	FOREIGN KEY (`nota_customer`) REFERENCES customer(`nrp_customer`),
-- 	FOREIGN KEY (`nota_courier`) REFERENCES courier(`nrp_courier`)
-- );



