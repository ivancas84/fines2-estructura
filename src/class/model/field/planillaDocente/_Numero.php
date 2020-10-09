<?php

require_once("class/model/Field.php");

class _FieldPlanillaDocenteNumero extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "255";  
  public $name = "numero";
  public $alias = "num";
  public $entityName = "planilla_docente";


}
