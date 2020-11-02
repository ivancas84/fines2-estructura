<?php

require_once("class/model/Field.php");

class _FieldPlanificacionAnio extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "anio";
  public $alias = "ani";
  public $entityName = "planificacion";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
