<?php

require_once("class/model/Field.php");

class _FieldComisionComentario extends Field {

  public $type = "text";
  public $fieldType = "nf";
  public $default = null;
  public $name = "comentario";
  public $alias = "com";
  public $entityName = "comision";
  public $dataType = "text";  
  public $subtype = "textarea";  
  public $length = "65535";  


}
