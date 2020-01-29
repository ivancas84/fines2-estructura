SELECT 
 CONCAT(
    "INSERT INTO planfi10_2020.comision (id, turno, division, anio, semestre, comentario, autorizada, apertura, publicada, fecha_anio, fecha_semestre, observaciones, alta, sede, plan, modalidad) 
VALUES ('", 
    HEX(comision.id), "', ", 
    IF(division.turno IS NOT NULL, CONCAT("'", REPLACE(division.turno, '\'', '\\\''), "'"), 'null'), ", ", 
    IF(division.serie IS NOT NULL, CONCAT("'", REPLACE(division.serie, '\'', '\\\''), "'"), 'null'), ", ", 
    IF(anio IS NOT NULL, CONCAT("'", REPLACE(anio, '\'', '\\\''), "'"), 'null'), ", ", 
    IF(semestre IS NOT NULL, CONCAT("'", REPLACE(semestre, '\'', '\\\''), "'"), 'null'), ", ",
	IF(comentario IS NOT NULL, CONCAT("'", REPLACE(comentario, '\'', '\\\''), "'"), 'null'), ", ",
	IF(autorizada IS NOT NULL, CONCAT("'", REPLACE(autorizada, '\'', '\\\''), "'"), 'null'), ", ",
	IF(apertura IS NOT NULL, CONCAT("'", REPLACE(apertura, '\'', '\\\''), "'"), 'null'), ", ",
	IF(publicar IS NOT NULL, CONCAT("'", REPLACE(publicar, '\'', '\\\''), "'"), 'null'), ", ",
	IF(fecha_anio IS NOT NULL, CONCAT("'", REPLACE(fecha_anio, '\'', '\\\''), "'"), 'null'), ", ",
	IF(fecha_semestre IS NOT NULL, CONCAT("'", REPLACE(fecha_semestre, '\'', '\\\''), "'"), 'null'), ", ",
	IF(observaciones IS NOT NULL, CONCAT("'", REPLACE(observaciones, '\'', '\\\''), "'"), 'null'), ", ",
	IF(alta IS NOT NULL, CONCAT("'", REPLACE(alta, '\'', '\\\''), "'"), 'null'), ", ",
	IF(sede IS NOT NULL, CONCAT("'", HEX(sede), "'"), 'null'), ", ",
	IF(plan IS NOT NULL, CONCAT("'", HEX(plan), "'"), 'null'), ", ",
	CASE 
        WHEN HEX(plan) = '1' THEN '\'1\''
        WHEN HEX(plan) = '2' THEN '\'1\''
        WHEN HEX(plan) = '4' THEN '\'1\''
		WHEN HEX(plan) = '5' THEN '\'1\''
		WHEN HEX(plan) = '3' THEN '\'5\''
		WHEN HEX(plan) = '367FE6CBD444EB' THEN '\'4\''
		WHEN HEX(plan) = '5C7942F7D4479' THEN '\'2\''
		WHEN HEX(plan) = '5D713352CC5BD' THEN '\'2\''
		WHEN HEX(plan) = '5D7ACEDBE52A7' THEN '\'3\''
        ELSE 'null'
    END,
"); ")
FROM comision
INNER JOIN  division ON (comision.division = division.id)
