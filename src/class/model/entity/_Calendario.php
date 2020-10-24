<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _CalendarioEntity extends Entity {
  public $name = "calendario";
  public $alias = "cale";
  public $nf = ['inicio', 'fin', 'anio', 'semestre', 'insertado'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['id', 'anio', 'semestre', 'insertado'];
  public $unique = ['id'];


}
