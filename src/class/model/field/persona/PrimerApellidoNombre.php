<?php

require_once("class/model/Field.php");

class FieldPersonaPrimerApellidoNombre extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "primer_apellido_nombre";
  public $alias = "pan";
  public $entityName = "persona";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
