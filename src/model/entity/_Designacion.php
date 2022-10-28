<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _DesignacionEntity extends Entity {
  public $name = "designacion";
  public $alias = "desi";
  public $nf = ['desde', 'hasta', 'alta'];
  public $mu = ['cargo', 'sede', 'persona'];
  public $_u = [];
  public $notNull = ['id', 'cargo', 'sede', 'persona', 'alta'];
  public $unique = ['id'];


}
