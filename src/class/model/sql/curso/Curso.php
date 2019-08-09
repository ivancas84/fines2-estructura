<?php

require_once("class/model/sql/curso/Main.php");

class CursoSql extends CursoSqlMain {


  public function _subSql(Render $render){ //subconsulta sql (en construccion)
    $t = $this->prt();

    return "SELECT *
FROM (


SELECT DISTINCT {$this->_fieldsDb()}, horario.horario, toma_activa.toma_activa
{$this->_from($render)}
LEFT OUTER JOIN (
  SELECT curso.id AS curso, GROUP_CONCAT(dia.dia, \" \", TIME_FORMAT(horario.hora_inicio, '%H:%i'), \" a \", TIME_FORMAT(horario.hora_fin, '%H:%i')) AS horario
  FROM curso
  INNER JOIN horario ON (horario.curso = curso.id)
  INNER JOIN dia ON (dia.id = horario.dia)
  INNER JOIN comision ON (comision.id = curso.comision)
  INNER JOIN division ON ( comision.division = division.id )
  INNER JOIN plan ON ( division.plan = plan.id )
  GROUP BY curso.id
) AS horario ON (horario.curso = {$t}.id)
LEFT OUTER JOIN (
  SELECT id AS toma_activa, curso
  FROM toma
  WHERE (toma.estado = 'Aprobada' OR toma.estado = 'Pendiente') AND (toma.estado_contralor != 'Modificar')
) AS toma_activa ON (toma_activa.curso = {$t}.id)


) AS {$t}
" . concat($this->_condition($render), 'WHERE ') . "
";
  }








  public function joinToma(){
    $p = $this->prf();
    $t = $this->prt();
    return "LEFT JOIN toma AS {$p}toma ON ({$p}toma.curso = {$t}.id)";
  }





/*
  //se incluye el horario
  public function _fieldAux($prefix = ""){
    $p = (empty($prefix)) ?  ''  : $prefix . '_';

    return "{$p}horario.horario AS {$p}horario";
  }

  //FIELD HORARIO: todos los horarios asociados al curso pueden ser concatenanadis en uno solo (ver joinHorario)
  public function fieldHorario($prefix = ""){
    $p = (empty($prefix)) ?  ''  : $prefix . '_';

    return "{$p}horario.horario AS {$p}horario";
  }

  //FIELD HORARIO: todos los horarios asociados al curso pueden ser concatenanadis en uno solo (ver joinHorario)
  public function fieldProfesorActivo($prefix = ""){
    $p = (empty($prefix)) ?  ''  : $prefix . '_';

    return "{$p}profesor.registrado as {$p}registrado, {$p}profesor.nombres as {$p}nombres, {$p}profesor.apellidos as {$p}apellidos, {$p}profesor.numero_documento as {$p}numero_documento";
  }







  public function joinProfesorActivo($prefix = ""){
    $p = (empty($prefix)) ? '' : $prefix . '_';
    $t = (empty($prefix)) ? 'curs.' : $prefix . '.';

    return "
LEFT JOIN (
  SELECT
    curso.id AS curso,
    id_persona.nombres, id_persona.apellidos, id_persona.numero_documento,
    IF(usuario.id IS NULL,true,false) AS registrado,
    toma.estado
  FROM curso
  INNER JOIN comision ON (curso.comision = comision.id)
  INNER JOIN toma ON (curso.id = toma.curso)
  INNER JOIN id_persona ON (toma.profesor = id_persona.id)
  LEFT JOIN usuario ON (id_persona.id = usuario.persona)
  WHERE (toma.estado = 'Aprobada' OR toma.estado = 'Pendiente')
  AND toma.estado_contralor != 'Modificar'
) AS {$p}profesor ON ({$p}profesor.curso = {$t}id)
";
}*/
}
