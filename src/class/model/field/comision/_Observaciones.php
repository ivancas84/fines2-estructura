<?php

require_once("class/model/Field.php");

class _FieldComisionObservaciones extends Field {

  public $type = "text";
  public $fieldType = "nf";
  public $default = null;
  public $length = "65535";  
  public $name = "observaciones";
  public $alias = "obs";
  public $entityName = "comision";


}
