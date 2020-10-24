<?php

require_once("class/model/Field.php");

class _FieldComisionComisionSiguiente extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "comision_siguiente";
  public $alias = "cs";
  public $entityName = "comision";
  public $entityRefName = "comision";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  
  public $value = "string";  


}
