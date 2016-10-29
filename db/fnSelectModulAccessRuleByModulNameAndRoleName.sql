CREATE OR REPLACE FUNCTION sc_sidika.fnSelectModulAccessRuleByModulNameAndRoleName(IN i_modul_name character varying, IN i_id_user integer)
  RETURNS TABLE(
  id_module_role integer,
is_read integer,
is_write integer,
is_delete integer,
is_update integer,
nama_modul text,
deskripsi_modul text,
nama_role text,
username text,
nama_profil text
  ) AS
$BODY$
DECLARE
BEGIN
  
 -- laksanakan query
 RETURN QUERY
select
		coalesce(sc_sidika.backbone_modul_role.id_module_role,0),
		coalesce(sc_sidika.backbone_modul_role.is_read,0),
		coalesce(sc_sidika.backbone_modul_role.is_write,0),
		coalesce(sc_sidika.backbone_modul_role.is_delete,0),
		coalesce(sc_sidika.backbone_modul_role.is_update,0),
		coalesce(sc_sidika.backbone_modul.nama_modul,'-')::text,
		coalesce(sc_sidika.backbone_modul.deskripsi_modul,'-')::text,
		coalesce(sc_sidika.backbone_role.nama_role,'-')::text,
		coalesce(sc_sidika.backbone_user.username,'-')::text,
		coalesce(sc_sidika.ref_pegawai.nama_sambung,'-')::text as nama_profil
	   from sc_sidika.backbone_modul_role
	   join sc_sidika.backbone_modul on sc_sidika.backbone_modul.id_modul = sc_sidika.backbone_modul_role.id_modul and sc_sidika.backbone_modul.record_active = '1'
	   join sc_sidika.backbone_role on sc_sidika.backbone_role.id_role = sc_sidika.backbone_modul_role.id_role and sc_sidika.backbone_role.record_active = '1'
	   join sc_sidika.backbone_user_role on sc_sidika.backbone_user_role.id_role = sc_sidika.backbone_role.id_role and sc_sidika.backbone_user_role.record_active = '1'
	   join sc_sidika.backbone_user on sc_sidika.backbone_user.id_user = sc_sidika.backbone_user_role.id_user and sc_sidika.backbone_user.id_user = i_id_user
	   join sc_sidika.ref_pegawai on sc_sidika.ref_pegawai.id_user = sc_sidika.backbone_user.id_user and sc_sidika.ref_pegawai.id_user = i_id_user
 where sc_sidika.backbone_modul.nama_modul = i_modul_name and sc_sidika.backbone_modul_role.record_active = '1';
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;