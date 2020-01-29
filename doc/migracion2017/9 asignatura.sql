SELECT CONCAT(
    "INSERT INTO planfi10_2020.asignatura (id, nombre, formacion, clasificacion, codigo, perfil) VALUES ('", 
    HEX(id), "', ", 
    IF(nombre IS NOT NULL, CONCAT("'", nombre, "'"), 'null'), ", ", 
	IF(formacion IS NOT NULL, CONCAT("'", formacion, "'"), 'null'), ", ", 
	IF(clasificacion IS NOT NULL, CONCAT("'", clasificacion, "'"), 'null'), ", ", 
    IF (codigo IS NOT NULL, CONCAT("'", codigo, "'"), 'null'), ", ", 
	IF(perfil IS NOT NULL, CONCAT("'", perfil, "'"), 'null'), 
    "); "
) FROM asignatura
