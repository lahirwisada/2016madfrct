-- Adminer 4.3.1 PostgreSQL dump

\connect "db_fcstprsn";

DROP TABLE IF EXISTS "backbone_modul";
CREATE SEQUENCE backbone_modul_id_modul_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "sc_fcstprsn"."backbone_modul" (
    "id_modul" integer DEFAULT nextval('backbone_modul_id_modul_seq') NOT NULL,
    "nama_modul" character varying(300),
    "deskripsi_modul" text,
    "turunan_dari" text,
    "no_urut" integer,
    "created_date" timestamp DEFAULT now(),
    "created_by" character varying(200),
    "modified_date" timestamp,
    "modified_by" character varying(200),
    "record_active" smallint DEFAULT 1,
    "show_on_menu" smallint DEFAULT 1,
    CONSTRAINT "pk_backbone_modul" PRIMARY KEY ("id_modul")
) WITH (oids = false);

CREATE TRIGGER "tru_backbone_modul" BEFORE UPDATE ON "sc_fcstprsn"."backbone_modul" FOR EACH ROW EXECUTE PROCEDURE tru_update_date();

<br />
<b>Fatal error</b>:  Call to undefined function truncate_sql() in <b>D:\Situs\adminer.php</b> on line <b>1436</b><br />
