SELECT CONCAT(
    "INSERT INTO planfi10_20202.telefono (id, tipo, prefijo, numero, insertado, eliminado, persona) VALUES ('", 
    HEX(id), "', ", 
	IF(tipo IS NOT NULL, CONCAT("'", tipo, "'"), 'null'), ", ",
    IF(prefijo IS NOT NULL, CONCAT("'", prefijo, "'"), 'null'), ", ",
    IF(numero IS NOT NULL, CONCAT("'", numero, "'"), 'null'), ", ",
    IF(alta IS NOT NULL, CONCAT("'", alta, "'"), 'null'), ", ",
    IF(baja IS NOT NULL, CONCAT("'", baja, "'"), 'null'), ", ", 
	IF(persona IS NOT NULL, CONCAT("'", HEX(persona), "'"), 'null'), 
    "); "
) FROM telefono;
