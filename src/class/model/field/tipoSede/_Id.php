<?php

require_once("class/model/Field.php");

class _FieldTipoSedeId extends Field {

  public $type = "varchar";
  public $fieldType = "pk";
  public $default = null;
  public $name = "id";
  public $alias = "id";
  public $entityName = "tipo_sede";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
