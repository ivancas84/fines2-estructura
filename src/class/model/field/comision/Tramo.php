<?php

require_once("class/model/field/comision/_Planificacion.php");

class FieldComisionTramo  extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $name = "tramo";
  public $entityName = "comision";
  public $dataType = "string";  
  public $subtype = "text";  
  public $length = "2";  

}
