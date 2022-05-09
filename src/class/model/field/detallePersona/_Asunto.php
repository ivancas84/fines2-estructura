<?php

require_once("class/model/Field.php");

class _FieldDetallePersonaAsunto extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "asunto";
  public $alias = "asu";
  public $entityName = "detalle_persona";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
