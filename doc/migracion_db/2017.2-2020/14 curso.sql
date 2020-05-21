SELECT CONCAT(
    "INSERT INTO planfi10_2020.curso (id, observaciones, comision, carga_horaria, alta) VALUES ('", 
    HEX(id), "', ", 
	IF(estado IS NOT NULL, CONCAT("'", REPLACE(estado, '\'', '\\\''), "'"), 'null'), ", ", 
    IF(comision IS NOT NULL, CONCAT("'", HEX(comision), "'"), 'null'), ", ", 
    IF(carga_horaria IS NOT NULL, CONCAT("'", HEX(carga_horaria), "'"), 'null'), ", ", 
    IF(alta IS NOT NULL, CONCAT("'", alta, "'"), 'null'),
    "); "
) FROM curso
