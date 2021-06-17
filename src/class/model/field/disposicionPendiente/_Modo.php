<?php

require_once("class/model/Field.php");

class _FieldDisposicionPendienteModo extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "modo";
  public $alias = "moa";
  public $entityName = "disposicion_pendiente";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}
