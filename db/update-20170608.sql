-- Table: sc_fcstprsn.master_golongan_pangkat

DROP TABLE IF EXISTS sc_fcstprsn.master_golongan_pangkat;

CREATE TABLE sc_fcstprsn.master_golongan_pangkat
(
  id_golongan serial NOT NULL,
  kode_golongan character varying(20),
  ur_golongan character varying(200),
  created_date date,
  created_by character varying(200),
  modified_date date,
  modified_by character varying(200),
  record_active smallint,
  CONSTRAINT pk_master_golongan_pangkat PRIMARY KEY (id_golongan)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sc_fcstprsn.master_golongan_pangkat
  OWNER TO postgres;

CREATE TRIGGER tru_master_golongan_pangkat
  BEFORE UPDATE
  ON sc_fcstprsn.master_golongan_pangkat
  FOR EACH ROW
  EXECUTE PROCEDURE sc_fcstprsn.tru_update_date();

INSERT INTO sc_fcstprsn.master_golongan_pangkat(
            id_golongan, kode_golongan, ur_golongan, created_date, created_by,
            modified_date, modified_by, record_active)
VALUES
(1,'TAMTAMA','TAMTAMA',NULL,'','2017-05-24','',1),
(2,'BINTARA','BINTARA',NULL,'','2017-05-24','',1),
(3,'PERWIRA','PERWIRA',NULL,'','2017-05-24','',1),
(4,'PNS','PEGAWAI NEGERI SIPIL',NULL,'','2017-05-24','',1);




-- Table: sc_fcstprsn.master_kelompok_pangkat

DROP TABLE IF EXISTS sc_fcstprsn.master_kelompok_pangkat;

CREATE TABLE sc_fcstprsn.master_kelompok_pangkat
(
  id_kelompok serial NOT NULL,
  kode_kelompok character varying(20),
  ur_kelompok character varying(200),
  created_date date,
  created_by character varying(200),
  modified_date date,
  modified_by character varying(200),
  record_active smallint,
  CONSTRAINT pk_master_kelompok_pangkat PRIMARY KEY (id_kelompok)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sc_fcstprsn.master_kelompok_pangkat
  OWNER TO postgres;

CREATE TRIGGER tru_master_kelompok_pangkat
  BEFORE UPDATE
  ON sc_fcstprsn.master_kelompok_pangkat
  FOR EACH ROW
  EXECUTE PROCEDURE sc_fcstprsn.tru_update_date();

INSERT INTO sc_fcstprsn.master_kelompok_pangkat(
            id_kelompok, kode_kelompok, ur_kelompok, created_date, created_by,
            modified_date, modified_by, record_active)
VALUES
(1,'PRAJURIT','PRAJURIT',NULL,'','2017-05-26','',1),
(2,'PRAKA','PRAJURIT KEPALA',NULL,'','2017-05-26','',1),
(3,'KOPRAL','KOPRAL',NULL,'','2017-05-26','',1),
(4,'KOPKA','KOPRAL KEPALA',NULL,'','2017-05-26','',1),
(5,'SRD/SRT','SERSAN DUA DAN SERSAN SATU',NULL,'','2017-05-26','',1),
(6,'SERKA','SERSAN KEPALA',NULL,'','2017-05-26','',1),
(7,'SERMA','SERSAN MAYOR',NULL,'','2017-05-26','',1),
(8,'PLD/PLT','PEMBANTU LETNAN DUA DAN PEMBANTU LETNAN SATU',NULL,'','2017-05-26','',1),
(9,'LETNAN','LETNAN',NULL,'','2017-05-26','',1),
(10,'KAPTEN','KAPTEN',NULL,'','2017-05-26','',1),
(11,'MAYOR','MAYOR',NULL,'','2017-05-26','',1),
(12,'LETKOL','LETNAN KOLONEL',NULL,'','2017-05-26','',1),
(13,'KOLONEL','KOLONEL',NULL,'','2017-05-26','',1),
(14,'BRIGJEN','BRIGADIR JENDERAL',NULL,'','2017-05-26','',1),
(15,'MAYJEN','MAYOR JENDERAL',NULL,'','2017-05-26','',1),
(16,'LETJEN','LETNAN JENDERAL',NULL,'','2017-05-26','',1),
(17,'JENDERAL','JENDERAL',NULL,'','2017-05-26','',1),
(18,'PNS','PEGAWAI NEGERI SIPIL',NULL,'','2017-05-26','',1);




-- Table: sc_fcstprsn.master_tingkat_pangkat

DROP TABLE IF EXISTS sc_fcstprsn.master_tingkat_pangkat;

CREATE TABLE sc_fcstprsn.master_tingkat_pangkat
(
  id_tingkat serial NOT NULL,
  kode_tingkat character varying(20),
  ur_tingkat character varying(200),
  created_date date,
  created_by character varying(200),
  modified_date date,
  modified_by character varying(200),
  record_active smallint,
  CONSTRAINT pk_master_tingkat_pangkat PRIMARY KEY (id_tingkat)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sc_fcstprsn.master_tingkat_pangkat
  OWNER TO postgres;

CREATE TRIGGER tru_master_tingkat_pangkat
  BEFORE UPDATE
  ON sc_fcstprsn.master_tingkat_pangkat
  FOR EACH ROW
  EXECUTE PROCEDURE sc_fcstprsn.tru_update_date();

INSERT INTO sc_fcstprsn.master_tingkat_pangkat(
            id_tingkat, kode_tingkat, ur_tingkat, created_date, created_by,
            modified_date, modified_by, record_active)
VALUES
(1,'TAMTAMA','TAMTAMA',NULL,'','2017-05-26','',1),
(2,'BINTARA','BINTARA',NULL,'','2017-05-26','',1),
(5,'PATI','PERWIRA TINGGI',NULL,'','2017-05-26','',1),
(4,'PAMEN','PERWIRA MENENGAH',NULL,'','2017-05-26','',1),
(3,'PAMA','PERWIRA PERTAMA',NULL,'','2017-05-26','',1),
(6,'PNS','PEGAWAI NEGERI SIPIL',NULL,'','2017-05-26','',1);




-- Table: sc_fcstprsn.master_pangkat

DROP TABLE IF EXISTS sc_fcstprsn.master_pangkat;

CREATE TABLE sc_fcstprsn.master_pangkat
(
  id_pangkat serial NOT NULL,
  kode_pangkat character varying(20),
  ur_pangkat character varying(200),
  id_kelompok smallint,
  id_golongan smallint,
  id_tingkat smallint,
  created_date date,
  created_by character varying(200),
  modified_date date,
  modified_by character varying(200),
  record_active smallint,
  CONSTRAINT pk_master_pangkat PRIMARY KEY (id_pangkat)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sc_fcstprsn.master_pangkat
  OWNER TO postgres;

CREATE TRIGGER tru_master_pangkat
  BEFORE UPDATE
  ON sc_fcstprsn.master_pangkat
  FOR EACH ROW
  EXECUTE PROCEDURE sc_fcstprsn.tru_update_date();

INSERT INTO sc_fcstprsn.master_pangkat(
            id_pangkat, kode_pangkat, ur_pangkat, id_kelompok, id_golongan,
            id_tingkat, created_date, created_by, modified_date, modified_by,
            record_active)
VALUES
(1,'51','PRADA',1,1,1,NULL,'','2017-05-27','',1),
(2,'52','PRATU',1,1,1,NULL,'','2017-05-27','',1),
(3,'53','PRAKA',2,1,1,NULL,'','2017-05-27','',1),
(4,'54','KOPDA',3,1,1,NULL,'','2017-05-27','',1),
(5,'55','KOPTU',3,1,1,NULL,'','2017-05-27','',1),
(6,'56','KOPKA',4,1,1,NULL,'','2017-05-27','',1),
(7,'61','SERDA',5,2,2,NULL,'','2017-05-27','',1),
(8,'62','SERTU',5,2,2,NULL,'','2017-05-27','',1),
(9,'63','SERKA',6,2,2,NULL,'','2017-05-27','',1),
(10,'64','SERMA',7,2,2,NULL,'','2017-05-27','',1),
(11,'65','PELDA',8,2,2,NULL,'','2017-05-27','',1),
(12,'66','PELTU',8,2,2,NULL,'','2017-05-27','',1),
(13,'67','CAPA',NULL,2,2,NULL,'','2017-01-27','',1),
(14,'71','LETDA',9,3,3,NULL,'','2017-05-27','',1),
(15,'72','LETTU',9,3,3,NULL,'','2017-05-27','',1),
(16,'73','KAPTEN',10,3,3,NULL,'','2017-05-27','',1),
(17,'81','MAYOR',11,3,4,NULL,'','2017-05-27','',1),
(18,'82','LETKOL',12,3,4,NULL,'','2017-05-27','',1),
(19,'83','KOLONEL',13,3,4,NULL,'','2017-05-27','',1),
(20,'91','BRIGJEN',14,3,5,NULL,'','2017-05-27','',1),
(21,'92','MAYJEN',15,3,5,NULL,'','2017-05-27','',1),
(22,'93','LETJEN',16,3,5,NULL,'','2017-05-27','',1),
(23,'94','JENDERAL',17,3,5,NULL,'','2017-05-27','',1),
(24,'11','I/A',18,4,6,NULL,'','2017-05-27','',1),
(25,'12','I/B',18,4,6,NULL,'','2017-05-27','',1),
(26,'13','I/C',18,4,6,NULL,'','2017-05-27','',1),
(27,'14','I/D',18,4,6,NULL,'','2017-05-27','',1),
(28,'21','II/A',18,4,6,NULL,'','2017-05-27','',1),
(29,'22','II/B',18,4,6,NULL,'','2017-05-27','',1),
(30,'23','II/C',18,4,6,NULL,'','2017-05-27','',1),
(31,'24','II/D',18,4,6,NULL,'','2017-05-27','',1),
(32,'31','III/A',18,4,6,NULL,'','2017-05-27','',1),
(33,'32','III/B',18,4,6,NULL,'','2017-05-27','',1),
(34,'33','III/C',18,4,6,NULL,'','2017-05-27','',1),
(35,'34','III/D',18,4,6,NULL,'','2017-05-27','',1),
(36,'41','IV/A',18,4,6,NULL,'','2017-05-27','',1),
(37,'42','IV/B',18,4,6,NULL,'','2017-05-27','',1),
(38,'43','IV/C',18,4,6,NULL,'','2017-05-27','',1),
(39,'44','IV/D',18,4,6,NULL,'','2017-05-27','',1),
(40,'45','IV/E',18,4,6,NULL,'','2017-05-27','',1);
