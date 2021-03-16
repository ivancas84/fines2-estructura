<?php

require_once("class/model/Field.php");

class _FieldTomaSinPlanillas extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "sin_planillas";
  public $alias = "sp";
  public $entityName = "toma";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
