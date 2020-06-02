INSERT INTO toma (id, fecha_toma, estado, observaciones, comentario, tipo_movimiento, estado_contralor, alta, curso, docente, reemplazo)
SELECT id, fecha_toma, estado, observaciones, comentario, tipo_movimiento, estado_contralor, alta, curso, docente, reemplazo 
FROM planfi10_20202.toma;

