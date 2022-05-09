<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _AlumnoEntity extends Entity {
  public $name = "alumno";
  public $alias = "alum";
  public $nf = ['anio_ingreso', 'observaciones', 'estado_inscripcion', 'fecha_titulacion', 'anio_inscripcion', 'semestre_inscripcion', 'semestre_ingreso', 'adeuda_legajo', 'adeuda_deudores', 'documentacion_inscripcion', 'anio_inscripcion_completo', 'establecimiento_inscripcion', 'libro_folio'];
  public $mu = ['plan', 'resolucion_inscripcion'];
  public $_u = ['persona'];
  public $notNull = ['id', 'persona'];
  public $unique = ['id', 'persona', 'libro_folio'];


}
