<?php

require_once("class/model/Field.php");

class FieldPersonaPrimerNombreApellido extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "primer_nombre_apellido";
  public $alias = "pna";
  public $entityName = "persona";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "255";  


}
