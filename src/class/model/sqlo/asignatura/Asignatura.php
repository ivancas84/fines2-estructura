<?php

require_once("class/model/sqlo/asignatura/Main.php");

//***** implementacion de Sqlo para una determinada tabla *****
class AsignaturaSqlo extends AsignaturaSqloMain{


  public function cantidadCursosPublicados($fecha){
     return "
SELECT asignatura.id AS asignatura, COUNT(*) AS cantidad_cursos
FROM asignatura
INNER JOIN carga_horaria ON (asignatura.id = carga_horaria.asignatura)
INNER JOIN curso ON (curso.carga_horaria = carga_horaria.id)
INNER JOIN comision ON (curso.comision = comision.id)
WHERE comision.fecha = '{$fecha}'
AND comision.publicar
GROUP BY asignatura
";
  }

  public function cantidadCursosPublicadosAprobados($fecha){
    return "
SELECT asignatura.id AS asignatura, COUNT(*) AS cantidad_cursos_aprobados
FROM asignatura
INNER JOIN carga_horaria ON (asignatura.id = carga_horaria.asignatura)
INNER JOIN curso ON (curso.carga_horaria = carga_horaria.id)
INNER JOIN comision ON (curso.comision = comision.id)
INNER JOIN toma ON (toma.curso = curso.id)
WHERE comision.fecha = '{$fecha}'
AND comision.publicar
AND (toma.estado = 'Aprobada' OR toma.estado = 'Pendiente')
AND toma.estado_contralor != 'Modificar'
GROUP BY asignatura
";
  }

  public function cantidadCursosPublicadosErrores($fecha){
    return "
SELECT asignatura.id AS asignatura, COUNT(*) AS cantidad_cursos_errores
FROM asignatura
INNER JOIN carga_horaria ON (asignatura.id = carga_horaria.asignatura)
INNER JOIN curso ON (curso.carga_horaria = carga_horaria.id)
INNER JOIN comision ON (curso.comision = comision.id)
INNER JOIN toma ON (toma.curso = curso.id)
WHERE comision.fecha = '{$fecha}'
AND comision.publicar
AND (toma.estado = 'Error' OR toma.estado = 'Observada')
GROUP BY asignatura
";
  }

  public function cantidadCursosPublicadosRenuncias($fecha){
    return "
SELECT asignatura.id AS asignatura, COUNT(*) AS cantidad_cursos_renuncias
FROM asignatura
INNER JOIN carga_horaria ON (asignatura.id = carga_horaria.asignatura)
INNER JOIN curso ON (curso.carga_horaria = carga_horaria.id)
INNER JOIN comision ON (curso.comision = comision.id)
INNER JOIN toma ON (toma.curso = curso.id)
WHERE comision.fecha = '{$fecha}'
AND comision.publicar
AND toma.estado = 'Renuncia'
GROUP BY asignatura
";
  }

  public function cantidadesCursosPublicados($fecha){
    $cantidadCursosPublicados = EntitySqlo::getInstanceString("asignatura")->cantidadCursosPublicados($fecha);
    $cantidadCursosPublicadosAprobados = EntitySqlo::getInstanceString("asignatura")->cantidadCursosPublicadosAprobados($fecha);
    $cantidadCursosPublicadosErrores = EntitySqlo::getInstanceString("asignatura")->cantidadCursosPublicadosErrores($fecha);
    $cantidadCursosPublicadosRenuncias = EntitySqlo::getInstanceString("asignatura")->cantidadCursosPublicadosRenuncias($fecha);

    return "
      SELECT asignatura.id, asignatura.nombre, cantidad_cursos, cantidad_cursos_aprobados, cantidad_cursos_errores, cantidad_cursos_renuncias
FROM asignatura
INNER JOIN (

  {$cantidadCursosPublicados}

) AS cantidad_cursos  ON (cantidad_cursos.asignatura = asignatura.id)
LEFT JOIN (

  {$cantidadCursosPublicadosAprobados}

) AS cantidad_cursos_aprobados ON (cantidad_cursos_aprobados.asignatura = asignatura.id)
LEFT JOIN (

  {$cantidadCursosPublicadosErrores}

) AS cantidad_cursos_errores ON (cantidad_cursos_errores.asignatura = asignatura.id)
LEFT JOIN (

  {$cantidadCursosPublicadosRenuncias}

) AS cantidad_cursos_renuncias ON (cantidad_cursos_renuncias.asignatura = asignatura.id)
";
  }

}
