<?php

require_once("class/model/Field.php");

class _FieldSedeTipoSede extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "tipo_sede";
  public $alias = "ts";
  public $entityName = "sede";
  public $entityRefName = "tipo_sede";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  
  public $value = "string";  


}
