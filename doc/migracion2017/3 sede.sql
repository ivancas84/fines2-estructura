SELECT CONCAT(
    "INSERT INTO planfi10_2020.sede (id, numero, nombre, observaciones, alta, domicilio, centro_educativo) VALUES ('", 
    HEX(id), "', ", 
    IF(numero IS NOT NULL, CONCAT("'", REPLACE(numero, '\'', '\\\''), "'"), 'null'), ", ", 
    IF(nombre IS NOT NULL, CONCAT("'", REPLACE(nombre, '\'', '\\\''), "'"), 'null'), ", ", 
    IF(observaciones IS NOT NULL, CONCAT("'", REPLACE(observaciones, '\'', '\\\''), "'"), 'null'), ", ", 
    IF(alta IS NOT NULL, CONCAT("'", REPLACE(alta, '\'', '\\\''), "'"), 'null'), ", ",
    IF(domicilio IS NOT NULL, CONCAT("'", HEX(domicilio), "'"), 'null'), ", ",
    CASE 
        WHEN dependencia = 1532435439156616 THEN '\'1\''
        WHEN dependencia = 15545038732435749 THEN '\'2\''
        WHEN dependencia = 15545040886549157 THEN '\'3\''
        ELSE 'null'
    END,
    "); "
) FROM sede
WHERE numero IS NOT NULL;
