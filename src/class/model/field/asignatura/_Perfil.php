<?php

require_once("class/model/Field.php");

class _FieldAsignaturaPerfil extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "perfil";
  public $alias = "per";
  public $entityName = "asignatura";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  
  public $value = "string";  


}
