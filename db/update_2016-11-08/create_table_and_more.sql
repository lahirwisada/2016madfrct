CREATE TABLE sc_fcstprsn.master_jenis_formulir
(
  id_jenis_formulir serial NOT NULL,
  kode_jenis_formulir character varying(60),
  nama_jenis_formulir character varying(150),
  keterangan_jenis_formulir text,
  created_date timestamp without time zone,
  created_by character varying(200),
  modified_date timestamp without time zone,
  modified_by character varying(200),
  record_active integer,
  CONSTRAINT pk_master_jenis_formulir PRIMARY KEY (id_jenis_formulir)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sc_fcstprsn.master_jenis_formulir
  OWNER TO postgres;


CREATE TRIGGER "tru_master_jenis_formulir" BEFORE UPDATE ON "sc_fcstprsn"."master_jenis_formulir"
FOR EACH ROW
EXECUTE PROCEDURE "sc_fcstprsn"."tru_update_date"();




-----------------------------------------------------------------
--  tr_f125t
-----------------------------------------------------------------

-- Table: sc_fcstprsn.tr_125t

-- DROP TABLE sc_fcstprsn.tr_125t;

CREATE TABLE sc_fcstprsn.tr_125t
(
  id_f125t serial NOT NULL,
  id_triwulan integer,
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
  CONSTRAINT pk_tr_125t PRIMARY KEY (id_f125t)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sc_fcstprsn.tr_125t
  OWNER TO postgres;
COMMENT ON COLUMN sc_fcstprsn.tr_125t.id_kabupaten_kota IS 'Kota Tanda Tangan

cth:

Surabaya, .... Nov 2016';


CREATE TRIGGER "tru_tr_125t" BEFORE UPDATE ON "sc_fcstprsn"."tr_125t"
FOR EACH ROW
EXECUTE PROCEDURE "sc_fcstprsn"."tru_update_date"();