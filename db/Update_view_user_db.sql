-- Adminer 4.3.0 PostgreSQL dump

DROP VIEW IF EXISTS "v_user";
CREATE TABLE "v_user" ("id_user" integer, "username" character varying(60), "record_active" smallint, "id_profil" integer, "nama_profil" character varying(200), "email_profil" character varying(100));


DROP TABLE IF EXISTS "v_user";
CREATE TABLE "sc_fcstprsn"."v_user" (
    "id_user" integer NOT NULL,
    "username" character varying(60) NOT NULL,
    "record_active" smallint NOT NULL,
    "id_profil" integer NOT NULL,
    "nama_profil" character varying(200) NOT NULL,
    "email_profil" character varying(100) NOT NULL
) WITH (oids = false);

-- 2017-06-09 23:11:28.844+07
