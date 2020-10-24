<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _SedeEntity extends Entity {
  public $name = "sede";
  public $alias = "sede";
  public $nf = ['numero', 'nombre', 'observaciones', 'alta', 'baja'];
  public $mu = ['domicilio', 'tipo_sede', 'centro_educativo'];
  public $_u = [];
  public $notNull = ['id', 'numero', 'nombre', 'alta'];
  public $unique = ['id'];


}
