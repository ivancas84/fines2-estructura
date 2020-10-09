<?php

require_once("class/model/Field.php");

class _FieldComisionAutorizada extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = null;
  public $length = "1";  
  public $name = "autorizada";
  public $alias = "aut";
  public $entityName = "comision";


}
