<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _AlumnoEntity extends Entity {
  public $name = "alumno";
  public $alias = "alum";
  public $nf = ['tiene_documento', 'tiene_partida_nacimiento', 'tiene_cuil', 'tiene_certificado_estudios', 'anio_ingreso', 'observaciones', 'legajo_completo', 'estado_inscripcion', 'fecha_titulacion'];
  public $mu = [];
  public $_u = ['persona'];
  public $notNull = ['id', 'tiene_documento', 'tiene_partida_nacimiento', 'tiene_cuil', 'tiene_certificado_estudios', 'persona', 'legajo_completo'];
  public $unique = ['id', 'persona'];


}
