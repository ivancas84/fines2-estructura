<?php

require_once("class/model/Field.php");

class _FieldTelefonoEliminado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = null;
  public $name = "eliminado";
  public $alias = "eli";
  public $entityName = "telefono";
  public $dataType = "timestamp";  
  public $subtype = "timestamp";  
  public $value = "datetime";  


}
