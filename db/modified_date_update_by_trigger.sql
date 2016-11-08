CREATE TRIGGER tru_ref_jenisidentitas
  BEFORE UPDATE
  ON sc_sidika.ref_jenisidentitas
  FOR EACH ROW
  EXECUTE PROCEDURE sc_sidika.tru_update_date();
