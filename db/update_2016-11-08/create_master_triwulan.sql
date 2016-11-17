CREATE TABLE sc_fcstprsn.master_triwulan
(
  id_triwulan serial NOT NULL,
  kode_triwulan character varying(20),
  nama_triwulan character varying(60),
  keterangan text,
  created_date timestamp without time zone,
  created_by character varying(200),
  modified_date timestamp without time zone,
  modified_by character varying(200),
  record_active smallint,
  CONSTRAINT pk_master_triwulan PRIMARY KEY (id_triwulan)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sc_fcstprsn.master_triwulan
  OWNER TO postgres;

-- Index: sc_fcstprsn.master_triwulan_pk

-- DROP INDEX sc_fcstprsn.master_triwulan_pk;

CREATE UNIQUE INDEX master_triwulan_pk
  ON sc_fcstprsn.master_triwulan
  USING btree
  (id_triwulan);


-- Trigger: tru_master_triwulan on sc_fcstprsn.master_triwulan

-- DROP TRIGGER tru_master_triwulan ON sc_fcstprsn.master_triwulan;

CREATE TRIGGER tru_master_triwulan
  BEFORE UPDATE
  ON sc_fcstprsn.master_triwulan
  FOR EACH ROW
  EXECUTE PROCEDURE sc_fcstprsn.tru_update_date();

