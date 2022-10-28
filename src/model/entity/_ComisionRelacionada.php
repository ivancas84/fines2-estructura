<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _ComisionRelacionadaEntity extends Entity {
  public $name = "comision_relacionada";
  public $alias = "cr";
  public $nf = [];
  public $mu = ['comision', 'relacion'];
  public $_u = [];
  public $notNull = ['id', 'comision', 'relacion'];
  public $unique = ['id'];


}
