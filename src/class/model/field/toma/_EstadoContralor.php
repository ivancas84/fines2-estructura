<?php

require_once("class/model/Field.php");

class _FieldTomaEstadoContralor extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "45";  
  public $name = "estado_contralor";
  public $alias = "ec";
  public $entityName = "toma";


}
