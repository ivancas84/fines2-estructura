INSERT INTO distribucion_horaria (id, anio, semestre, asignatura, horas_catedra, dia, plan)
SELECT d.id, ch.anio, ch.semestre, ch.asignatura, d.horas_catedra, d.dia, ch.plan
FROM planfi10_2020.distribucion_horaria AS d
INNER JOIN planfi10_2020.carga_horaria AS ch ON (d.carga_horaria = ch.id)
