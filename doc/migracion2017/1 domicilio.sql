SELECT CONCAT(
    "INSERT INTO planfi10_2020.domicilio (id, calle, entre, numero, piso, departamento, barrio, localidad) VALUES ('", 
    HEX(id), "', ", 
    IF(calle IS NOT NULL, CONCAT("'", REPLACE(calle, '\'', '\\\''), "'"), 'null'), ", ", 
    IF(entre IS NOT NULL, CONCAT("'", REPLACE(entre, '\'', '\\\''), "'"), 'null'), ", ", 
	IF(numero IS NOT NULL, CONCAT("'", REPLACE(numero, '\'', '\\\''), "'"), 'null'), ", ", 
    IF(piso IS NOT NULL, CONCAT("'", REPLACE(piso, '\'', '\\\''), "'"), 'null'), ", ",
    IF(departamento IS NOT NULL, CONCAT("'", REPLACE(departamento, '\'', '\\\''), "'"), 'null'), ", ",
	IF(barrio IS NOT NULL, CONCAT("'", REPLACE(barrio, '\'', '\\\''), "'"), 'null'), ", ",
    IF(localidad IS NOT NULL, CONCAT("'", REPLACE(localidad, '\'', '\\\''), "'"), 'null'),
    "); "
) FROM domicilio
