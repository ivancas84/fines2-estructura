<?php

require_once("class/model/Field.php");

class _FieldEmailEliminado extends Field {

  public $type = "timestamp";
  public $fieldType = "nf";
  public $default = null;
  public $name = "eliminado";
  public $alias = "eli";
  public $entityName = "email";
  public $dataType = "timestamp";  
  public $subtype = "timestamp";  


}
