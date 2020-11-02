<?php

require_once("class/model/Field.php");

class _FieldPlanificacionSemestre extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "semestre";
  public $alias = "sem";
  public $entityName = "planificacion";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
