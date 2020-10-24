<?php

require_once("class/model/Field.php");

class _FieldTomaComentario extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "comentario";
  public $alias = "com";
  public $entityName = "toma";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  
  public $value = "string";  


}
