<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _AlumnoComisionEntity extends Entity {
  public $name = "alumno_comision";
  public $alias = "ac";
  public $nf = ['fotocopia_documento', 'partida_nacimiento', 'creado', 'constancia_cuil', 'certificado_estudios', 'anio_ingreso', 'activo', 'programa', 'observaciones'];
  public $mu = ['comision', 'alumno'];
  public $_u = [];
  public $notNull = ['id', 'fotocopia_documento', 'partida_nacimiento', 'creado', 'constancia_cuil', 'certificado_estudios', 'alumno'];
  public $unique = ['id'];


}
