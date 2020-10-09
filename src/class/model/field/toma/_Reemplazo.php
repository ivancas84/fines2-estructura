<?php

require_once("class/model/Field.php");

class _FieldTomaReemplazo extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $length = "45";  
  public $name = "reemplazo";
  public $alias = "ree";
  public $entityName = "toma";
  public $entityRefName = "persona";  


}
