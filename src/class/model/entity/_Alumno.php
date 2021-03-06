<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _AlumnoEntity extends Entity {
  public $name = "alumno";
  public $alias = "alum";
  public $nf = ['anio_ingreso', 'observaciones', 'estado_inscripcion', 'fecha_titulacion', 'anio_inscripcion', 'semestre_inscripcion', 'semestre_ingreso', 'adeuda_legajo', 'adeuda_deudores', 'tiene_dni', 'tiene_partida', 'tiene_cuil', 'tiene_constancia_primaria', 'tiene_certificado_primaria', 'tiene_constancia_secundaria', 'tiene_analitico_secundaria', 'tiene_declaracion_jurada'];
  public $mu = ['plan', 'resolucion_inscripcion'];
  public $_u = ['persona'];
  public $notNull = ['id', 'persona', 'tiene_dni', 'tiene_partida', 'tiene_cuil', 'tiene_constancia_primaria', 'tiene_certificado_primaria', 'tiene_constancia_secundaria', 'tiene_analitico_secundaria', 'tiene_declaracion_jurada'];
  public $unique = ['id', 'persona'];


}
