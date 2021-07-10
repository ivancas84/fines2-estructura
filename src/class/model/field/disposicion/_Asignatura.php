<?php

require_once("class/model/Field.php");

class _FieldDisposicionAsignatura extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "asignatura";
  public $alias = "asi";
  public $entityName = "disposicion";
  public $entityRefName = "asignatura";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
