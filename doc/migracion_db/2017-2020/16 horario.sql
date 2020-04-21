SELECT CONCAT(
    "INSERT INTO planfi10_2020.horario (id, hora_inicio, hora_fin, dia, curso) VALUES ('", 
    HEX(id), "', ", 
	IF(hora_inicio IS NOT NULL, CONCAT("'", hora_inicio, "'"), 'null'), ", ", 
	IF(hora_fin IS NOT NULL, CONCAT("'", hora_fin, "'"), 'null'), ", ", 
	IF(dia IS NOT NULL, CONCAT("'", HEX(dia), "'"), 'null'),   ", ", 
	IF(curso IS NOT NULL, CONCAT("'", HEX(curso), "'"), 'null'),  
    "); "
) FROM horario
