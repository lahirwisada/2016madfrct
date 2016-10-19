
------------------------------------
-- CREATE TABLE master_provinsi
------------------------------------

CREATE TABLE sc_fcstprsn.master_provinsi
(
  id_provinsi serial NOT NULL,
  kode_provinsi character varying(20),
  nama_provinsi character varying(200),
  created_date date,
  created_by character varying(200),
  modified_date date,
  modified_by character varying(200),
  record_active smallint,
  CONSTRAINT pk_master_provinsi PRIMARY KEY (id_provinsi)
)
WITH (
  OIDS=FALSE
);

-- Index: sc_sidika.master_provinsi_pk

-- DROP INDEX sc_sidika.master_provinsi_pk;

CREATE UNIQUE INDEX master_provinsi_pk
  ON sc_fcstprsn.master_provinsi
  USING btree
  (id_provinsi);


-- Trigger: tru_master_provinsi on sc_sidika.master_provinsi

-- DROP TRIGGER tru_master_provinsi ON sc_sidika.master_provinsi;

CREATE TRIGGER tru_master_provinsi
  BEFORE UPDATE
  ON sc_fcstprsn.master_provinsi
  FOR EACH ROW
  EXECUTE PROCEDURE sc_fcstprsn.tru_update_date();
