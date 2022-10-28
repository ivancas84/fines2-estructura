<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _AlumnoComisionEntity extends Entity {
  public $name = "alumno_comision";
  public $alias = "ac";
  public $nf = ['creado', 'activo', 'observaciones'];
  public $mu = ['comision', 'alumno'];
  public $_u = [];
  public $notNull = ['id', 'creado', 'alumno'];
  public $unique = ['id'];


}
