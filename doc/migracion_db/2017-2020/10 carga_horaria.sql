SELECT CONCAT(
    "INSERT INTO planfi10_2020.carga_horaria (id, anio, semestre, horas_catedra, plan, asignatura) VALUES (",
	CONCAT("'", HEX(id), "'"), ", ",
    IF(anio IS NOT NULL, CONCAT("'", anio, "'"), 'null'), ", ", 
	IF(semestre IS NOT NULL, CONCAT("'", semestre, "'"), 'null'), ", ", 
	IF(horas_catedra IS NOT NULL, CONCAT("'", horas_catedra, "'"), 'null'), ", ", 
    CONCAT("'", HEX(plan), "'"), ", ", 
	CONCAT("'", HEX(asignatura), "'"),
    "); "
) FROM carga_horaria
