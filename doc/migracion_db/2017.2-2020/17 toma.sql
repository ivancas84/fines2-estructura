SELECT CONCAT(
    "INSERT INTO planfi10_2020.toma (id, fecha_toma, fecha_inicio, fecha_fin, fecha_contralor, estado, observaciones, comentario, tipo_movimiento, estado_contralor, alta, curso, docente, reemplazo) VALUES ('", 
    HEX(id), "', ", 
	IF(fecha_toma IS NOT NULL, CONCAT("'", fecha_toma, "'"), 'null'), ", ", 
	IF(fecha_inicio IS NOT NULL, CONCAT("'", fecha_inicio, "'"), 'null'), ", ", 
	IF(fecha_fin IS NOT NULL, CONCAT("'", fecha_fin, "'"), 'null'), ", ", 
	IF(fecha_entrada_contralor IS NOT NULL, CONCAT("'", fecha_entrada_contralor, "'"), 'null'), ", ",   
	IF(estado IS NOT NULL, CONCAT("'", estado, "'"), 'null'), ", ", 
	IF(observaciones IS NOT NULL, CONCAT("'", observaciones, "'"), 'null'), ", ",   
	IF(comentario_contralor IS NOT NULL, CONCAT("'", comentario_contralor, "'"), 'null'), ", ",    
	IF(tipo_movimiento IS NOT NULL, CONCAT("'", tipo_movimiento, "'"), 'null'), ", ",         
	IF(estado_contralor IS NOT NULL, CONCAT("'", estado_contralor, "'"), 'null'), ", ",  
	IF(alta IS NOT NULL, CONCAT("'", alta, "'"), 'null'), ", ",   	 
	IF(curso IS NOT NULL, CONCAT("'", HEX(curso), "'"), 'null'), ", ",   
	IF(profesor IS NOT NULL, CONCAT("'", HEX(profesor), "'"), 'null'), ", ",  
	IF(reemplaza IS NOT NULL, CONCAT("'", HEX(reemplaza), "'"), 'null'),
    "); "
) FROM toma
