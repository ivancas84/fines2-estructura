<?php

require_once("class/model/Field.php");

class _FieldTomaReemplazo extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "reemplazo";
  public $alias = "ree";
  public $entityName = "toma";
  public $entityRefName = "persona";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
