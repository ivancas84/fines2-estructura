<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _PlanEntity extends Entity {
  public $name = "plan";
  public $alias = "plan";
  public $main = ['id'];
  public $pk = ['id'];
  public $nf = ['orientacion', 'resolucion', 'distribucion_horaria'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['id', 'orientacion'];
  public $unique = ['id'];
  public $admin = ['id', 'orientacion', 'resolucion', 'distribucion_horaria'];



}
