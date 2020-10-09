<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _DomicilioEntity extends Entity {
  public $name = "domicilio";
  public $alias = "domi";
  public $main = ['id'];
  public $pk = ['id'];
  public $nf = ['calle', 'entre', 'numero', 'piso', 'departamento', 'barrio', 'localidad'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['id', 'calle', 'numero', 'localidad'];
  public $unique = ['id'];
  public $admin = ['id', 'calle', 'entre', 'numero', 'piso', 'departamento', 'barrio', 'localidad'];



}
