INSERT INTO toma (id, fecha_toma, fecha_inicio, fecha_fin, fecha_contralor, estado, observaciones, comentario, tipo_movimiento, estado_contralor, alta, curso, docente, reemplazo)
SELECT id, fecha_toma, fecha_inicio, fecha_fin, fecha_contralor, estado, observaciones, comentario, tipo_movimiento, estado_contralor, alta, curso, docente, reemplazo FROM planfi10_2020.toma;
