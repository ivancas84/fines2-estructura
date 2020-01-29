SELECT CONCAT(
    "INSERT INTO planfi10_2020.dia (id, numero, dia) VALUES ('", 
    HEX(id), "', ", 
	numero, ", ", 
    CONCAT("'", dia, "'"),
    "); "
) FROM dia
