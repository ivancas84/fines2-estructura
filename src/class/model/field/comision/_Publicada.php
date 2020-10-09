<?php

require_once("class/model/Field.php");

class _FieldComisionPublicada extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = null;
  public $length = "1";  
  public $name = "publicada";
  public $alias = "pub";
  public $entityName = "comision";


}
