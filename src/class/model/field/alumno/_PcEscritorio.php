<?php

require_once("class/model/Field.php");

class _FieldAlumnoPcEscritorio extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "pc_escritorio";
  public $alias = "pe";
  public $entityName = "alumno";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "45";  


}