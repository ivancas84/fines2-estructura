<?php

require_once("class/model/Field.php");

class _FieldComisionModalidad extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "modalidad";
  public $alias = "moa";
  public $entityName = "comision";
  public $entityRefName = "modalidad";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
