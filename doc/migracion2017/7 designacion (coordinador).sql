SELECT CONCAT(
    "INSERT INTO planfi10_2020.designacion (id, desde, hasta, cargo, sede, persona) VALUES ('", 
    CONCAT('G',HEX(id)), "', ", 
    IF(alta IS NOT NULL, CONCAT("'", alta, "'"), 'null'), ", ", 
	IF(baja IS NOT NULL, CONCAT("'", baja, "'"), 'null'), ", ", 
	"'2', ",
	IF(sede IS NOT NULL, CONCAT("'", HEX(sede), "'"), 'null'), ", ", 
	IF(persona IS NOT NULL, CONCAT("'", HEX(persona), "'"), 'null'),
    "); "
) FROM coordinador
