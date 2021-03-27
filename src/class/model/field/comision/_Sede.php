<?php

require_once("class/model/Field.php");

class _FieldComisionSede extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "sede";
  public $alias = "sed";
  public $entityName = "comision";
  public $entityRefName = "sede";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
