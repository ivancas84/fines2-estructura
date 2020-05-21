SELECT CONCAT(
    "INSERT INTO planfi10_2020.plan (id, orientacion, resolucion) VALUES ('", 
    HEX(id), "', ", 
    IF(orientacion IS NOT NULL, CONCAT("'", orientacion, "'"), 'null'), ", ", 
	IF(resolucion IS NOT NULL, CONCAT("'", resolucion, "'"), 'null'), 
    "); "
) FROM plan
