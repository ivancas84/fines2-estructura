<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _DisposicionPendienteEntity extends Entity {
  public $name = "disposicion_pendiente";
  public $alias = "dpa";
  public $nf = ['modo'];
  public $mu = ['disposicion', 'alumno'];
  public $_u = [];
  public $notNull = ['id', 'disposicion', 'alumno'];
  public $unique = ['id'];


}
