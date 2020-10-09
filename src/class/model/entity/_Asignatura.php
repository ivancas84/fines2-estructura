<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _AsignaturaEntity extends Entity {
  public $name = "asignatura";
  public $alias = "asig";
  public $main = ['id'];
  public $pk = ['id'];
  public $nf = ['nombre', 'formacion', 'clasificacion', 'codigo', 'perfil'];
  public $mu = [];
  public $_u = [];
  public $notNull = ['id', 'nombre'];
  public $unique = ['id', 'nombre'];
  public $admin = ['id', 'nombre', 'formacion', 'clasificacion', 'codigo', 'perfil'];



}
