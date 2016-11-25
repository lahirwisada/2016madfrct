-- Table: sc_fcstprsn.tr_126t

-- DROP TABLE sc_fcstprsn.tr_126t;

CREATE TABLE sc_fcstprsn.tr_126t
(
  id_f126t serial NOT NULL,
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
  CONSTRAINT pk_tr_126t PRIMARY KEY (id_f126t)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sc_fcstprsn.tr_126t
  OWNER TO postgres;
COMMENT ON COLUMN sc_fcstprsn.tr_126t.id_kabupaten_kota IS 'Kota Tanda Tangan

cth:

Surabaya, .... Nov 2016';


-- Trigger: tru_tr_126t on sc_fcstprsn.tr_126t

-- DROP TRIGGER tru_tr_126t ON sc_fcstprsn.tr_126t;

CREATE TRIGGER tru_tr_126t
  BEFORE UPDATE
  ON sc_fcstprsn.tr_126t
  FOR EACH ROW
  EXECUTE PROCEDURE sc_fcstprsn.tru_update_date();

-- Table: sc_fcstprsn.tr_126t_detail

-- DROP TABLE sc_fcstprsn.tr_126t_detail;

CREATE TABLE sc_fcstprsn.tr_126t_detail
(
  id_f126t_detail serial NOT NULL,
  id_f126t integer,
  id_pangkat integer,
  jumlah_sd integer,
  jumlah_sltp integer,
  jumlah_slta integer,
  jumlah_d1 integer,
  jumlah_d2 integer,
  jumlah_d3 integer,
  jumlah_d4 integer,
  jumlah_s1 integer,
  jumlah_s2 integer,
  jumlah_s3 integer,
  jumlah_subtotal integer,
  created_date timestamp without time zone,
  created_by character varying(200),
  modified_date timestamp without time zone,
  modified_by character varying(200),
  record_active integer DEFAULT 1,
  CONSTRAINT pk_tr_126t_detail PRIMARY KEY (id_f126t_detail),
  CONSTRAINT fk_tr_126t_detail_tr_126t FOREIGN KEY (id_f126t)
      REFERENCES sc_fcstprsn.tr_126t (id_f126t) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sc_fcstprsn.tr_126t_detail
  OWNER TO postgres;

-- Trigger: tru_tr_126t_detail on sc_fcstprsn.tr_126t_detail

-- DROP TRIGGER tru_tr_126t_detail ON sc_fcstprsn.tr_126t_detail;

CREATE TRIGGER tru_tr_126t_detail
  BEFORE UPDATE
  ON sc_fcstprsn.tr_126t_detail
  FOR EACH ROW
  EXECUTE PROCEDURE sc_fcstprsn.tru_update_date();