<?php

require_once("class/model/Field.php");

class _FieldAlumnoTienePartida extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "tiene_partida";
  public $alias = "tp";
  public $entityName = "alumno";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
