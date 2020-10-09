<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _PlanificacionEntity extends Entity {
  public $name = "planificacion";
  public $alias = "pla";
  public $main = ['id'];
  public $pk = ['id'];
  public $nf = ['anio', 'semestre'];
  public $mu = ['plan'];
  public $_u = [];
  public $notNull = ['id', 'anio', 'semestre', 'plan'];
  public $unique = ['id'];
  public $admin = ['id', 'anio', 'semestre', 'plan'];



}
