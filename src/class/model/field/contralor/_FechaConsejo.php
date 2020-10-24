<?php

require_once("class/model/Field.php");

class _FieldContralorFechaConsejo extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $default = null;
  public $name = "fecha_consejo";
  public $alias = "fca";
  public $entityName = "contralor";
  public $dataType = "date";  
  public $subtype = "date";  
  public $value = "datetime";  


}
