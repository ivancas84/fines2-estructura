<?php

require_once("class/model/Field.php");

class _FieldPlanOrientacion extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "orientacion";
  public $alias = "ori";
  public $entityName = "plan";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
