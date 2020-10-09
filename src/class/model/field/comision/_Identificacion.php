<?php

require_once("class/model/Field.php");

class _FieldComisionIdentificacion extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "45";  
  public $name = "identificacion";
  public $alias = "ide";
  public $entityName = "comision";


}
