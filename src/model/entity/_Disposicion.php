<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _DisposicionEntity extends Entity {
  public $name = "disposicion";
  public $alias = "disp";
  public $nf = [];
  public $mu = ['asignatura', 'planificacion'];
  public $_u = [];
  public $notNull = ['id', 'asignatura', 'planificacion'];
  public $unique = ['id'];


}
