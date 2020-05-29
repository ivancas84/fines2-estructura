INSERT INTO curso (id, comision, asignatura, horas_catedra, alta)
SELECT c.id, c.comision, ch.asignatura, ch.horas_catedra, c.alta
FROM planfi10_2020.curso AS c
INNER JOIN planfi10_2020.carga_horaria AS ch ON (c.carga_horaria = ch.id)

