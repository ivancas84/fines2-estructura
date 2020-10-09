<?php

require_once("class/model/Field.php");

class _FieldPlanResolucion extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "45";  
  public $name = "resolucion";
  public $alias = "res";
  public $entityName = "plan";


}
