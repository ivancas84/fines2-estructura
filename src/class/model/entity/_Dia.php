<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _DiaEntity extends Entity {
  public $name = "dia";
  public $alias = "dia";
  public $main = ['id'];
  public $pk = ['id'];
  public $nf = ['numero', 'dia'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['id', 'numero', 'dia'];
  public $unique = ['id', 'numero', 'dia'];
  public $admin = ['id', 'numero', 'dia'];



}
