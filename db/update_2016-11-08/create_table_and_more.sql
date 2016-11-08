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


-----------------------------------------------------------------
--  tr_f125t_detail
-----------------------------------------------------------------


CREATE TABLE sc_fcstprsn.tr_125t_detail
(
  id_f125t_detail serial NOT NULL,
  id_f125t integer,
  id_pangkat integer,
  jumlah_secata integer,
  jumlah_secaba integer,
  jumlah_sesarcab integer,
  jumlah_selapa_setingkat integer,
  jumlah_sesko_angkatan_setingkat integer,
  jumlah_sesko_tni integer,
  jumlah_subtotal integer,
  created_date timestamp without time zone,
  created_by character varying(200),
  modified_date timestamp without time zone,
  modified_by character varying(200),
  record_active integer DEFAULT 1,
  CONSTRAINT pk_tr_125t_detail PRIMARY KEY (id_f125t_detail),
  CONSTRAINT fk_tr_125t_detail_tr_125t FOREIGN KEY (id_f125t)
      REFERENCES sc_fcstprsn.tr_125t (id_f125t) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sc_fcstprsn.tr_125t_detail
  OWNER TO postgres;


CREATE TRIGGER "tru_tr_125t_detail" BEFORE UPDATE ON "sc_fcstprsn"."tr_125t_detail"
FOR EACH ROW
EXECUTE PROCEDURE "sc_fcstprsn"."tru_update_date"();