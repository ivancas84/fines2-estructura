<?php

require_once("class/model/Field.php");

class _FieldDetallePersonaTipo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "tipo";
  public $alias = "tip";
  public $entityName = "detalle_persona";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
