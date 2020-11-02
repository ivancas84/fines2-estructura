<?php

require_once("class/model/Field.php");

class _FieldPlanResolucion extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "resolucion";
  public $alias = "res";
  public $entityName = "plan";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
