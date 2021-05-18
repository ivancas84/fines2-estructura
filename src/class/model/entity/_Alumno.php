<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _AlumnoEntity extends Entity {
  public $name = "alumno";
  public $alias = "alum";
  public $nf = ['anio_ingreso', 'observaciones', 'legajo_completo', 'estado_inscripcion', 'fecha_titulacion'];
  public $mu = ['plan'];
  public $_u = ['persona'];
  public $notNull = ['id', 'persona', 'legajo_completo'];
  public $unique = ['id', 'persona'];


}
