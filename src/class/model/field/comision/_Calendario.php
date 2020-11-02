<?php

require_once("class/model/Field.php");

class _FieldComisionCalendario extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "calendario";
  public $alias = "cal";
  public $entityName = "comision";
  public $entityRefName = "calendario";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
