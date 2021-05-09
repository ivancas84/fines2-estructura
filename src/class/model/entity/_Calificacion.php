<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _CalificacionEntity extends Entity {
  public $name = "calificacion";
  public $alias = "cali";
  public $nf = ['nota1', 'nota2', 'nota3', 'nota_final', 'crec', 'porcentaje_asistencia', 'observaciones'];
  public $mu = ['curso', 'persona', 'asignatura', 'planificacion'];
  public $_u = [];
  public $notNull = ['id', 'persona', 'asignatura', 'planificacion'];
  public $unique = ['id'];


}
