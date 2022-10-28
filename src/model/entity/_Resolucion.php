<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _ResolucionEntity extends Entity {
  public $name = "resolucion";
  public $alias = "reso";
  public $nf = ['numero', 'anio', 'tipo'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['id', 'numero'];
  public $unique = ['id'];


}
