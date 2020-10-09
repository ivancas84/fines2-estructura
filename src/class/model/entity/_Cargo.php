<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _CargoEntity extends Entity {
  public $name = "cargo";
  public $alias = "carg";
  public $main = ['id'];
  public $pk = ['id'];
  public $nf = ['descripcion'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['id', 'descripcion'];
  public $unique = ['id', 'descripcion'];
  public $admin = ['id', 'descripcion'];



}
