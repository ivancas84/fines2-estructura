<?php

require_once("class/model/Field.php");

class _FieldPlanillaDocenteInsertado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = "current_timestamp()";
  public $length = false;  
  public $name = "insertado";
  public $alias = "ins";
  public $entityName = "planilla_docente";


}
