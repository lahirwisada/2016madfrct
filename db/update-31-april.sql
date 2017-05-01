-- Adminer 4.3.0 PostgreSQL dump

DROP TABLE IF EXISTS "master_satuan";
CREATE SEQUENCE master_satuan_id_satuan_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "sc_fcstprsn"."master_satuan" (
    "id_satuan" integer DEFAULT nextval('master_satuan_id_satuan_seq'),
    "kode_satuan" character varying(200),
    "nama_satuan" character varying(200),
    "ur_satuan" character varying(200),
    "created_date" date,
    "created_by" character varying(200),
    "modified_date" date,
    "modified_by" character varying(200),
    "record_active" smallint
) WITH (oids = false);

INSERT INTO "master_satuan" ("id_satuan", "kode_satuan", "nama_satuan", "ur_satuan", "created_date", "created_by", "modified_date", "modified_by", "record_active") VALUES
(1,	'a13',	'adadada',	'aaaa',	'2017-05-01',	'Admin',	'2017-05-01',	'Admin',	1);

DROP TABLE IF EXISTS "master_tingkatkategori";
CREATE SEQUENCE master_tingkatkategori_id_tingkatkategori_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "sc_fcstprsn"."master_tingkatkategori" (
    "id_tingkatkategori" integer DEFAULT nextval('master_tingkatkategori_id_tingkatkategori_seq'),
    "kode_tingkatkategori" character varying(200),
    "nama_tingkatkategori" character varying(200),
    "ur_tingkatkategori" character varying(200),
    "created_date" date,
    "created_by" character varying(200),
    "modified_date" date,
    "modified_by" character varying(200),
    "record_active" smallint
) WITH (oids = false);


-- 2017-05-01 07:36:43.291+07
