<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _CalificacionEntity extends Entity {
  public $name = "calificacion";
  public $alias = "cali";
  public $nf = ['nota1', 'nota2', 'nota3', 'nota_final', 'crec', 'porcentaje_asistencia', 'observaciones', 'division'];
  public $mu = ['curso', 'alumno', 'disposicion'];
  public $_u = [];
  public $notNull = ['id', 'alumno'];
  public $unique = ['id'];


}
