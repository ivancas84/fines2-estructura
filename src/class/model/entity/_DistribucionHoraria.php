<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _DistribucionHorariaEntity extends Entity {
  public $name = "distribucion_horaria";
  public $alias = "dh";
  public $main = ['id'];
  public $pk = ['id'];
  public $nf = ['horas_catedra', 'dia'];
  public $mu = ['asignatura', 'planificacion'];
  public $_u = [];
  public $notNull = ['id', 'horas_catedra', 'dia', 'asignatura', 'planificacion'];
  public $unique = ['id'];
  public $admin = ['id', 'horas_catedra', 'dia', 'asignatura', 'planificacion'];



}
