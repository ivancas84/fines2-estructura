<?php

require_once("class/model/Field.php");

class _FieldDiaNumero extends Field {

  public $type = "smallint";
  public $fieldType = "nf";
  public $default = null;
  public $length = "1";  
  public $name = "numero";
  public $alias = "num";
  public $entityName = "dia";


}
