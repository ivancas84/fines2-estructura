<?php

require_once("class/model/Field.php");

class _FieldTomaEstadoContralor extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "estado_contralor";
  public $alias = "ec";
  public $entityName = "toma";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  
  public $value = "string";  


}
