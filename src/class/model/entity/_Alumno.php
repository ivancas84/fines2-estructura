<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _AlumnoEntity extends Entity {
  public $name = "alumno";
  public $alias = "alum";
  public $nf = ['anio_ingreso', 'observaciones', 'estado_inscripcion', 'fecha_titulacion', 'estado_legajo', 'anio_inscripcion', 'semestre_inscripcion', 'semestre_ingreso', 'tramo_inscripcion_completo', 'adeuda_inscripcion'];
  public $mu = ['plan', 'resolucion_inscripcion'];
  public $_u = ['persona'];
  public $notNull = ['id', 'persona'];
  public $unique = ['id', 'persona'];


}
