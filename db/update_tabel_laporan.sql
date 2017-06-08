/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Rinaldi
 * Created: Jun 8, 2017
 */

-- Table: sc_fcstprsn.tr_pasukan_rekap

DROP TABLE IF EXISTS sc_fcstprsn.tr_pasukan_rekap;

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

CREATE TRIGGER tru_tr_pasukan_rekap
  BEFORE UPDATE
  ON sc_fcstprsn.tr_pasukan_rekap
  FOR EACH ROW
  EXECUTE PROCEDURE sc_fcstprsn.tru_update_date();


  
  
-- Table: sc_fcstprsn.tr_pasukan_detail

DROP TABLE IF EXISTS sc_fcstprsn.tr_pasukan_detail;

CREATE TABLE sc_fcstprsn.tr_pasukan_detail
(
  id_rekap integer NOT NULL,
  id_satminkal integer NOT NULL,
  id_pangkat integer NOT NULL,
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
  CONSTRAINT pk_tr_pasukan_detail PRIMARY KEY (id_rekap, id_satminkal, id_pangkat)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sc_fcstprsn.tr_pasukan_detail
  OWNER TO postgres;

CREATE TRIGGER tru_tr_pasukan_detail
  BEFORE UPDATE
  ON sc_fcstprsn.tr_pasukan_detail
  FOR EACH ROW
  EXECUTE PROCEDURE sc_fcstprsn.tru_update_date();

