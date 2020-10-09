<?php

require_once("class/model/Field.php");

class _FieldSedeBaja extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = null;
  public $length = false;  
  public $name = "baja";
  public $alias = "baj";
  public $entityName = "sede";


}
