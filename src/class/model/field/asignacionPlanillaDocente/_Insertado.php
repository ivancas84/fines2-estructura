<?php

require_once("class/model/Field.php");

class _FieldAsignacionPlanillaDocenteInsertado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = "current_timestamp()";
  public $length = false;  
  public $name = "insertado";
  public $alias = "ins";
  public $entityName = "asignacion_planilla_docente";


}
