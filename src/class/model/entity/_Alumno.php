<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _AlumnoEntity extends Entity {
  public $name = "alumno";
  public $alias = "alum";
  public $nf = ['documento', 'partida_nacimiento', 'cuil', 'certificado_estudios', 'anio_ingreso', 'observaciones'];
  public $mu = ['persona'];
  public $_u = [];
  public $notNull = ['id', 'documento', 'partida_nacimiento', 'cuil', 'certificado_estudios', 'persona'];
  public $unique = ['id'];


}
