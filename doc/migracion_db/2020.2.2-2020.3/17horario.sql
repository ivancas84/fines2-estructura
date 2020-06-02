INSERT INTO  planfi10_20203.horario (id, hora_inicio, hora_fin, dia, curso)
SELECT id, hora_inicio, hora_fin, dia, curso FROM planfi10_20202.horario;

