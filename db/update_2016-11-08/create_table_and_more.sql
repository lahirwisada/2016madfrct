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