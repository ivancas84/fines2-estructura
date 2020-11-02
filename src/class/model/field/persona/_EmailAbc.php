<?php

require_once("class/model/Field.php");

class _FieldPersonaEmailAbc extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "email_abc";
  public $alias = "ea";
  public $entityName = "persona";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
