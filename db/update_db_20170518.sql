-- Table: sc_fcstprsn.tr_pasukan_rekap

DROP TABLE sc_fcstprsn.tr_pasukan_rekap;

CREATE TABLE sc_fcstprsn.tr_pasukan_rekap
(
  id_rekap serial NOT NULL,
  id_bulan integer,
  id_tahun integer,
  id_kotama integer,
  path_excel character varying(1000),
  tanggal_upload date,
  tanggal_ttd date,
  uraian_atas_ttd text,
  jabatan_ttd text,
  nama_ttd character varying(200),
  pangkat_ttd character varying(200),
  nrp_ttd character varying(200),
  id_kabupaten_kota integer, -- Kota Tanda Tangan...
  created_date timestamp without time zone,
  created_by character varying(200),
  modified_date timestamp without time zone,
  modified_by character varying(200),
  record_active integer DEFAULT 1,
  CONSTRAINT pk_tr_pasukan_rekap PRIMARY KEY (id_rekap),
  CONSTRAINT constrains_unique_kotama_bulan_tahun UNIQUE (id_bulan, id_tahun, id_kotama)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sc_fcstprsn.tr_pasukan_rekap
  OWNER TO postgres;
COMMENT ON COLUMN sc_fcstprsn.tr_pasukan_rekap.id_kabupaten_kota IS 'Kota Tanda Tangan

cth:

Surabaya, .... Nov 2016';


-- Trigger: tru_tr_pasukan_rekap on sc_fcstprsn.tr_pasukan_rekap

-- DROP TRIGGER tru_tr_pasukan_rekap ON sc_fcstprsn.tr_pasukan_rekap;

CREATE TRIGGER tru_tr_pasukan_rekap
  BEFORE UPDATE
  ON sc_fcstprsn.tr_pasukan_rekap
  FOR EACH ROW
  EXECUTE PROCEDURE sc_fcstprsn.tru_update_date();


-- Table: sc_fcstprsn.tr_pasukan_detail

DROP TABLE sc_fcstprsn.tr_pasukan_detail;

CREATE TABLE sc_fcstprsn.tr_pasukan_detail
(
  id_detail serial NOT NULL,
  id_rekap integer,
  id_satminkal integer,
  id_pangkat integer,
  top integer,
  dinas integer,
  mpp integer,
  lf integer,
  skorsing integer,
  created_date timestamp without time zone,
  created_by character varying(200),
  modified_date timestamp without time zone,
  modified_by character varying(200),
  record_active integer DEFAULT 1,
  id_triwulan integer,
  CONSTRAINT pk_tr_pasukan_detail PRIMARY KEY (id_detail)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sc_fcstprsn.tr_pasukan_detail
  OWNER TO postgres;

-- Trigger: tru_tr_pasukan_detail on sc_fcstprsn.tr_pasukan_detail

-- DROP TRIGGER tru_tr_pasukan_detail ON sc_fcstprsn.tr_pasukan_detail;

CREATE TRIGGER tru_tr_pasukan_detail
  BEFORE UPDATE
  ON sc_fcstprsn.tr_pasukan_detail
  FOR EACH ROW
  EXECUTE PROCEDURE sc_fcstprsn.tru_update_date();


INSERT INTO "backbone_modul" ("id_modul", "nama_modul", "deskripsi_modul", "turunan_dari", "no_urut", "created_date", "created_by", "modified_date", "modified_by", "record_active", "show_on_menu") VALUES
(1,	'sistem',	'Sistem',	'',	9900,	'2017-05-16 00:00:00',	'',	'2017-05-16 00:00:00',	'',	1,	1),
(2,	'modul',	'Modul',	'sistem',	9901,	'2017-05-16 00:00:00',	'',	'2017-05-16 00:00:00',	'',	1,	1),
(3,	'member',	'Member',	'sistem',	9902,	'2017-05-16 00:00:00',	'',	'2017-05-16 00:00:00',	'',	1,	1),
(4,	'role',	'Role',	'sistem',	9903,	'2017-05-16 00:00:00',	'',	'2017-05-16 00:00:00',	'',	1,	1),
(5,	'pustaka_data',	'Pustaka Data',	'',	2000,	'2017-05-16 00:00:00',	'',	'2017-05-16 00:00:00',	'',	1,	1),
(6,	'msbulan',	'Master Bulan',	'pustaka_data',	2001,	'2017-05-16 00:00:00',	'',	'2017-05-16 00:00:00',	'',	1,	1),
(7,	'mscorps',	'Master Corps',	'pustaka_data',	2002,	'2017-05-16 00:00:00',	'',	'2017-05-16 00:00:00',	'',	1,	1),
(8,	'mspangkat',	'Master Pangkat',	'pustaka_data',	2003,	'2017-05-16 00:00:00',	'',	'2017-05-16 00:00:00',	'',	1,	1),
(9,	'mskesatuan',	'Master Kesatuan',	'pustaka_data',	2004,	'2017-05-16 00:00:00',	'',	'2017-05-16 00:00:00',	'',	1,	1),
(10,	'mskotama',	'Master Kotama',	'pustaka_data',	2005,	'2017-05-16 00:00:00',	'',	'2017-05-16 00:00:00',	'',	1,	1),
(11,	'mssatminkal',	'Master Satminkal',	'pustaka_data',	2006,	'2017-05-16 00:00:00',	'',	'2017-05-16 00:00:00',	'',	1,	1),
(12,	'upload',	'Upload Data',	'',	3000,	'2017-05-16 00:00:00',	'',	'2017-05-16 00:00:00',	'',	1,	1),
(13,	'rkpasukan',	'Rekap Pasukan',	'upload',	3001,	'2017-05-16 00:00:00',	'',	'2017-05-16 00:00:00',	'',	1,	1),
(14,	'laporan',	'Laporan',	'',	4000,	'2017-05-17 00:00:00',	'',	'2017-05-17 00:00:00',	'',	1,	1),
(15,	'lpstruktur',	'Kekuatan Struktur',	'laporan',	4001,	'2017-05-17 00:00:00',	'',	'2017-05-17 00:00:00',	'',	1,	1),
(16,	'lpkotama',	'Kekuatan Kotama',	'laporan',	4002,	'2017-05-17 00:00:00',	'',	'2017-05-17 00:00:00',	'',	1,	1),
(17,	'lpkecabangan',	'Kekuatan Perkecabangan',	'laporan',	4003,	'2017-05-17 00:00:00',	'',	'2017-05-17 00:00:00',	'',	1,	1),
(18,	'lpsatpur',	'Kekuatan Tempur',	'laporan',	4004,	'2017-05-17 00:00:00',	'',	'2017-05-17 00:00:00',	'',	1,	1),
(19,	'lpsatbalak',	'Kekuatan Satbalak',	'laporan',	4005,	'2017-05-17 00:00:00',	'',	'2017-05-17 00:00:00',	'',	1,	1),
(20,	'lpsatkowil',	'Kekuatan Satkowil',	'laporan',	4006,	'2017-05-17 00:00:00',	'',	'2017-05-17 00:00:00',	'',	1,	1);

INSERT INTO "backbone_modul_role" ("id_module_role", "id_role", "id_modul", "is_read", "is_write", "is_delete", "is_update", "created_date", "created_by", "modified_date", "modified_by", "record_active") VALUES
(1,	1,	1,	1,	1,	1,	1,	'2017-05-17 01:33:22',	'Admin',	'2017-05-17 06:33:53.011',	'Admin',	1),
(2,	1,	2,	1,	1,	1,	1,	'2017-05-17 01:33:22',	'Admin',	'2017-05-17 06:33:54.925',	'Admin',	1),
(3,	1,	3,	1,	1,	1,	1,	'2017-05-17 01:33:22',	'Admin',	'2017-05-17 06:33:56.455',	'Admin',	1),
(4,	1,	4,	1,	1,	1,	1,	'2017-05-17 01:33:22',	'Admin',	'2017-05-17 06:33:57.814',	'Admin',	1),
(5,	1,	5,	1,	1,	1,	1,	'2017-05-17 01:33:22',	'Admin',	'2017-05-17 06:34:00.217',	'Admin',	1),
(6,	1,	6,	1,	1,	1,	1,	'2017-05-17 01:33:22',	'Admin',	'2017-05-17 06:34:01.342',	'Admin',	1),
(7,	1,	7,	1,	1,	1,	1,	'2017-05-17 01:33:22',	'Admin',	'2017-05-17 06:34:02.638',	'Admin',	1),
(8,	1,	8,	1,	1,	1,	1,	'2017-05-17 01:33:22',	'Admin',	'2017-05-17 06:34:03.927',	'Admin',	1),
(9,	1,	9,	1,	1,	1,	1,	'2017-05-17 01:33:22',	'Admin',	'2017-05-17 06:34:05.279',	'Admin',	1),
(10,	1,	10,	1,	1,	1,	1,	'2017-05-17 01:33:22',	'Admin',	'2017-05-17 06:34:07.512',	'Admin',	1),
(11,	1,	11,	1,	1,	1,	1,	'2017-05-17 01:33:22',	'Admin',	'2017-05-17 06:34:08.825',	'Admin',	1),
(12,	1,	12,	1,	1,	1,	1,	'2017-05-17 01:33:22',	'Admin',	'2017-05-17 06:34:10.246',	'Admin',	1),
(13,	1,	13,	1,	1,	1,	1,	'2017-05-17 01:33:22',	'Admin',	'2017-05-17 06:34:12.065',	'Admin',	1),
(14,	1,	14,	1,	1,	1,	1,	'2017-05-17 01:33:22',	'Admin',	'2017-05-17 06:34:13.604',	'Admin',	1),
(15,	1,	15,	1,	1,	1,	1,	'2017-05-17 01:33:22',	'Admin',	'2017-05-17 06:34:15.228',	'Admin',	1),
(16,	1,	16,	1,	1,	1,	1,	'2017-05-17 01:33:22',	'Admin',	'2017-05-17 06:34:17.22',	'Admin',	1),
(17,	1,	17,	1,	1,	1,	1,	'2017-05-17 01:33:22',	'Admin',	'2017-05-17 06:34:19.157',	'Admin',	1),
(18,	1,	18,	1,	1,	1,	1,	'2017-05-17 01:33:22',	'Admin',	'2017-05-17 06:34:21.048',	'Admin',	1),
(19,	1,	19,	1,	1,	1,	1,	'2017-05-17 01:33:22',	'Admin',	'2017-05-17 06:34:23.063',	'Admin',	1),
(20,	1,	20,	1,	1,	1,	1,	'2017-05-17 01:33:22',	'Admin',	'2017-05-17 06:34:25.172',	'Admin',	1);