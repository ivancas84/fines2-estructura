<?php

require_once("class/model/Field.php");

class _FieldAsignacionPlanillaDocenteReclamo extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "reclamo";
  public $alias = "rec";
  public $entityName = "asignacion_planilla_docente";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
