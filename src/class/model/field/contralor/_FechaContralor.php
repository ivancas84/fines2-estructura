<?php

require_once("class/model/Field.php");

class _FieldContralorFechaContralor extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $default = null;
  public $length = false;  
  public $name = "fecha_contralor";
  public $alias = "fc";
  public $entityName = "contralor";


}
