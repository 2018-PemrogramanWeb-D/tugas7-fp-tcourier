/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     10/24/2018 11:37:44 AM                       */
/*==============================================================*/


drop table if exists MAKANAN;

drop table if exists TEMPAT;

/*==============================================================*/
/* Table: MAKANAN                                               */
/*==============================================================*/
create table MAKANAN
(
   ID_MAKANAN           char(2) not null,
   ID                   char(2) not null,
   NAMA                 char(50),
   HARGA_MAKANAN        float(6,0),
   primary key (ID_MAKANAN)
);

/*==============================================================*/
/* Table: TEMPAT                                                */
/*==============================================================*/
create table TEMPAT
(
   ID                   char(2) not null,
   NAMA_TEMPAT          varchar(50),
   ONGKOS               float(6,0),
   primary key (ID)
);

alter table MAKANAN add constraint FK_TERDAPAT foreign key (ID)
      references TEMPAT (ID) on delete restrict on update restrict;

