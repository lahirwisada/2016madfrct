
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

CREATE UNIQUE INDEX master_provinsi_pk
  ON sc_fcstprsn.master_provinsi
  USING btree
  (id_provinsi);

CREATE TRIGGER tru_master_provinsi
  BEFORE UPDATE
  ON sc_fcstprsn.master_provinsi
  FOR EACH ROW
  EXECUTE PROCEDURE sc_fcstprsn.tru_update_date();


------------------------------------
-- CREATE TABLE master_kabupaten_kota
------------------------------------

CREATE TABLE sc_fcstprsn.master_kabupaten_kota
(
  id_kabupaten_kota serial NOT NULL,
  id_provinsi integer,
  kode_kabupaten character varying(30),
  nama_kabupaten character varying(200),
  is_ibukota smallint,
  keterangan text,
  created_date date,
  created_by character varying(200),
  modified_date date,
  modified_by character varying(200),
  record_active smallint,
  CONSTRAINT pk_master_kabupaten_kota PRIMARY KEY (id_kabupaten_kota),
  CONSTRAINT fk_master_kabu_master_prov FOREIGN KEY (id_provinsi)
      REFERENCES sc_fcstprsn.master_provinsi (id_provinsi) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sc_fcstprsn.master_kabupaten_kota
  OWNER TO postgres;

CREATE INDEX fk_master_provinsi_master_kabupaten_f
  ON sc_fcstprsn.master_kabupaten_kota
  USING btree
  (id_provinsi);

CREATE UNIQUE INDEX master_kabupaten_kota_ak
  ON sc_fcstprsn.master_kabupaten_kota
  USING btree
  (id_kabupaten_kota);

CREATE TRIGGER tru_master_kabupaten_kota
  BEFORE UPDATE
  ON sc_fcstprsn.master_kabupaten_kota
  FOR EACH ROW
  EXECUTE PROCEDURE sc_fcstprsn.tru_update_date();
