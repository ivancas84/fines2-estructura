SELECT 
 CONCAT(
    "UPDATE planfi10_2020.comision SET comision_siguiente = ",
	CONCAT("'", HEX(comision_siguiente), "'"),
	" WHERE id = ",
	CONCAT("'", HEX(id), "'"),   
	"; ")
FROM comision
WHERE comision_siguiente IS NOT NULL;
