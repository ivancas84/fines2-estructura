<?php

require_once("class/model/Field.php");

class _FieldPlanillaDocenteNumero extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "numero";
  public $alias = "num";
  public $entityName = "planilla_docente";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
