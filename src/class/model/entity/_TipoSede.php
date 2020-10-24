<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _TipoSedeEntity extends Entity {
  public $name = "tipo_sede";
  public $alias = "ts";
  public $nf = ['descripcion'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['id', 'descripcion'];
  public $unique = ['id', 'descripcion'];


}
