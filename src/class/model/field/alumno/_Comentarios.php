<?php

require_once("class/model/Field.php");

class _FieldAlumnoComentarios extends Field {

  public $type = "text";
  public $fieldType = "nf";
  public $default = null;
  public $name = "comentarios";
  public $alias = "com";
  public $entityName = "alumno";
  public $dataType = "text";  
  public $subtype = "textarea";  
  public $length = "65535";  


}
