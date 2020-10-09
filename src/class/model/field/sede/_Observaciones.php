<?php

require_once("class/model/Field.php");

class _FieldSedeObservaciones extends Field {

  public $type = "text";
  public $fieldType = "nf";
  public $default = null;
  public $length = "65535";  
  public $name = "observaciones";
  public $alias = "obs";
  public $entityName = "sede";


}
