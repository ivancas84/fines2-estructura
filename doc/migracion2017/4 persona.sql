SELECT 
 CONCAT(
    "INSERT INTO planfi10_2020.persona (id, nombres, apellidos, fecha_nacimiento, numero_documento, cuil, email, genero, apodo, alta, domicilio) VALUES ('", 
    HEX(id), "', ", 
    IF(nombres IS NOT NULL, CONCAT("'", REPLACE(nombres, '\'', '\\\''), "'"), 'null'), ", ", 
    IF(apellidos IS NOT NULL, CONCAT("'", REPLACE(apellidos, '\'', '\\\''), "'"), 'null'), ", ", 
    IF(fecha_nacimiento IS NOT NULL, CONCAT("'", REPLACE(fecha_nacimiento, '\'', '\\\''), "'"), 'null'), ", ", 
    IF(numero_documento IS NOT NULL, CONCAT("'", REPLACE(numero_documento, '\'', '\\\''), "'"), 'null'), ", ",
	IF(cuil IS NOT NULL, CONCAT("'", REPLACE(cuil, '\'', '\\\''), "'"), 'null'), ", ",
	IF(email IS NOT NULL, CONCAT("'", REPLACE(email, '\'', '\\\''), "'"), 'null'), ", ",
	IF(genero IS NOT NULL, CONCAT("'", REPLACE(genero, '\'', '\\\''), "'"), 'null'), ", ",
	IF(sobrenombre IS NOT NULL, CONCAT("'", REPLACE(sobrenombre, '\'', '\\\''), "'"), 'null'), ", ",
	IF(alta IS NOT NULL, CONCAT("'", REPLACE(alta, '\'', '\\\''), "'"), 'null'), ", ",
	IF(domicilio IS NOT NULL, CONCAT("'", HEX(domicilio), "'"), 'null'), 
"); ")
FROM id_persona
LEFT JOIN  (
    SELECT id_persona, MAX(domicilio) AS domicilio
    FROM persona
    WHERE baja IS NULL
    GROUP BY id_persona
) AS p ON (p.id_persona = id_persona.id)