<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _PlanEntity extends Entity {
  public $name = "plan";
  public $alias = "plan";
  public $nf = ['orientacion', 'resolucion', 'distribucion_horaria'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['id', 'orientacion'];
  public $unique = ['id'];


}
