/**
 * Author:  Rinaldi
 * Created: Jun 8, 2017
 */

-- Table: sc_fcstprsn.backbone_modul

DROP TABLE IF EXISTS sc_fcstprsn.backbone_modul_role;

DROP TABLE IF EXISTS sc_fcstprsn.backbone_modul;

CREATE TABLE sc_fcstprsn.backbone_modul
(
  id_modul serial NOT NULL,
  nama_modul character varying(300),
  deskripsi_modul text,
  turunan_dari text,
  no_urut integer,
  created_date timestamp without time zone DEFAULT now(),
  created_by character varying(200),
  modified_date timestamp without time zone,
  modified_by character varying(200),
  record_active smallint DEFAULT 1,
  show_on_menu smallint DEFAULT 1,
  CONSTRAINT pk_backbone_modul PRIMARY KEY (id_modul)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sc_fcstprsn.backbone_modul
  OWNER TO postgres;

CREATE TRIGGER tru_backbone_modul
  BEFORE UPDATE
  ON sc_fcstprsn.backbone_modul
  FOR EACH ROW
  EXECUTE PROCEDURE sc_fcstprsn.tru_update_date();

-- Table: sc_fcstprsn.backbone_modul_role

CREATE TABLE sc_fcstprsn.backbone_modul_role
(
  id_module_role serial NOT NULL,
  id_role integer,
  id_modul integer,
  is_read smallint,
  is_write smallint,
  is_delete smallint,
  is_update smallint,
  created_date timestamp without time zone DEFAULT now(),
  created_by character varying(200),
  modified_date timestamp without time zone,
  modified_by character varying(200),
  record_active smallint DEFAULT 1,
  CONSTRAINT pk_backbone_module_role PRIMARY KEY (id_module_role),
  CONSTRAINT fk_backbone_modul_role_backbone_modul FOREIGN KEY (id_modul)
      REFERENCES sc_fcstprsn.backbone_modul (id_modul) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fk_backbone_modul_role_backbone_role FOREIGN KEY (id_role)
      REFERENCES sc_fcstprsn.backbone_role (id_role) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sc_fcstprsn.backbone_modul_role
  OWNER TO postgres;

CREATE TRIGGER tru_backbone_modul_role
  BEFORE UPDATE
  ON sc_fcstprsn.backbone_modul_role
  FOR EACH ROW
  EXECUTE PROCEDURE sc_fcstprsn.tru_update_date();

INSERT INTO sc_fcstprsn.backbone_modul(
            id_modul, nama_modul, deskripsi_modul, turunan_dari, no_urut, 
            created_date, created_by, modified_date, modified_by, record_active, 
            show_on_menu)
    VALUES 
(1,'sistem','Sistem','',9900,'2017-05-17','',NULL,'',1,1),
(2,'modul','Modul','sistem',9901,'2017-05-17','',NULL,'',1,1),
(3,'member','Member','sistem',9902,'2017-05-17','',NULL,'',1,1),
(4,'role','Role','sistem',9903,'2017-05-17','',NULL,'',1,1),
(5,'pustaka_data','Pustaka Data','',2000,'2017-05-17','',NULL,'',1,1),
(6,'msbulan','Master Bulan','pustaka_data',2001,'2017-05-17','',NULL,'',1,1),
(7,'mscorps','Master Corps','pustaka_data',2002,'2017-05-17','',NULL,'',1,1),
(8,'mspangkat','Master Pangkat','pustaka_data',2003,'2017-05-17','',NULL,'',1,1),
(9,'msgolonganpangkat','Master Golongan Pangkat','pustaka_data',2007,'2017-05-17','',NULL,'',1,1),
(10,'mskelompokpangkat','Master Kelompok Pangkat','pustaka_data',2008,'2017-05-17','',NULL,'',1,1),
(11,'mstingkatpangkat','Master Tingkat Pangkat','pustaka_data',2009,'2017-05-17','',NULL,'',1,1),
(12,'mskesatuan','Master Kesatuan','pustaka_data',2004,'2017-05-17','',NULL,'',1,1),
(13,'mskotama','Master Kotama','pustaka_data',2005,'2017-05-17','',NULL,'',1,1),
(14,'mssatminkal','Master Satminkal','pustaka_data',2006,'2017-05-17','',NULL,'',1,1),
(15,'upload','Upload Data','',3000,'2017-05-17','',NULL,'',1,1),
(16,'rkpasukan','Rekap Pasukan','upload',3001,'2017-05-17','',NULL,'',1,1),
(17,'laporan','Laporan','',4000,'2017-05-17','',NULL,'',1,1),
(18,'lpstruktur','Kekuatan Struktur','laporan',4001,'2017-05-17','',NULL,'',1,1),
(19,'lpkotama','Kekuatan Kotama','laporan',4002,'2017-05-17','',NULL,'',1,1),
(20,'lpkecabangan','Kekuatan Perkecabangan','laporan',4003,'2017-05-17','',NULL,'',1,1),
(21,'lpsatpur','Kekuatan Tempur','laporan',4004,'2017-05-17','',NULL,'',1,1),
(22,'lpsatbalak','Kekuatan Satbalak','laporan',4005,'2017-05-17','',NULL,'',1,1),
(23,'lpsatkowil','Kekuatan Satkowil','laporan',4006,'2017-05-17','',NULL,'',1,1);

INSERT INTO sc_fcstprsn.backbone_modul_role(
            id_module_role, id_role, id_modul, is_read, is_write, is_delete, 
            is_update, created_date, created_by, modified_date, modified_by, 
            record_active)
    VALUES 
(1,1,1,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(2,1,2,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(3,1,3,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(4,1,4,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(5,1,5,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(6,1,6,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(7,1,7,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(8,1,8,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(9,1,9,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(10,1,10,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(11,1,11,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(12,1,12,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(13,1,13,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(14,1,14,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(15,1,15,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(16,1,16,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(17,1,17,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(18,1,18,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(19,1,19,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(20,1,20,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(21,1,21,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(22,1,22,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(23,1,23,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(24,2,15,1,1,1,1,'2017-05-17','Admin',NULL,'',1),
(25,2,16,1,1,1,1,'2017-05-17','Admin',NULL,'',1);
