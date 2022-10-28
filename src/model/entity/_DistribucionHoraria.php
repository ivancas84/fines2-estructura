<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _DistribucionHorariaEntity extends Entity {
  public $name = "distribucion_horaria";
  public $alias = "dh";
  public $nf = ['horas_catedra', 'dia'];
  public $mu = ['disposicion'];
  public $_u = [];
  public $notNull = ['id', 'horas_catedra', 'dia'];
  public $unique = ['id'];


}
