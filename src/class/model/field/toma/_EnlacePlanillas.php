<?php

require_once("class/model/Field.php");

class _FieldTomaEnlacePlanillas extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "enlace_planillas";
  public $alias = "ep";
  public $entityName = "toma";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
