<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _AsignaturaEntity extends Entity {
  public $name = "asignatura";
  public $alias = "asig";
  public $nf = ['nombre', 'formacion', 'clasificacion', 'codigo', 'perfil'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['id', 'nombre'];
  public $unique = ['id', 'nombre', 'codigo'];


}
