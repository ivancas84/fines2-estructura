SELECT CONCAT(
    "INSERT INTO planfi10_2020.distribucion_horaria (id, carga_horaria, horas_catedra, dia) VALUES ('", 
    HEX(id), "', ",  
	IF(carga_horaria IS NOT NULL, CONCAT("'", HEX(carga_horaria), "'"), 'null'), ", ",  
	horas_catedra, ", ",  
	dia,
    "); "
) FROM distribucion_horaria
