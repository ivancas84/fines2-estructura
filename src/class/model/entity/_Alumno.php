<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _AlumnoEntity extends Entity {
  public $name = "alumno";
  public $alias = "alum";
  public $nf = ['fotocopia_documento', 'partida_nacimiento', 'creado', 'constancia_cuil', 'certificado_estudios', 'anio_ingreso', 'activo', 'observaciones'];
  public $mu = ['persona', 'comision'];
  public $_u = [];
  public $notNull = ['id', 'fotocopia_documento', 'partida_nacimiento', 'creado', 'constancia_cuil', 'certificado_estudios', 'persona'];
  public $unique = ['id'];


}
