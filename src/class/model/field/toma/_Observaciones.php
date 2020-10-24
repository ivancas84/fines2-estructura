<?php

require_once("class/model/Field.php");

class _FieldTomaObservaciones extends Field {

  public $type = "text";
  public $fieldType = "nf";
  public $default = null;
  public $name = "observaciones";
  public $alias = "obs";
  public $entityName = "toma";
  public $dataType = "text";  
  public $subtype = "textarea";  
  public $length = "65535";  
  public $value = "string";  


}
