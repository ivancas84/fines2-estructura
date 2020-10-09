<?php

require_once("class/model/Field.php");

class _FieldTomaDocente extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $length = "45";  
  public $name = "docente";
  public $alias = "doc";
  public $entityName = "toma";
  public $entityRefName = "persona";  


}
