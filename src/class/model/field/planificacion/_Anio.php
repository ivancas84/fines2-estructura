<?php

require_once("class/model/Field.php");

class _FieldPlanificacionAnio extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "45";  
  public $name = "anio";
  public $alias = "ani";
  public $entityName = "planificacion";


}
