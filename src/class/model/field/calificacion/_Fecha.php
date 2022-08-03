<?php

require_once("class/model/Field.php");

class _FieldCalificacionFecha extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $default = null;
  public $name = "fecha";
  public $alias = "fec";
  public $entityName = "calificacion";
  public $dataType = "date";  
  public $subtype = "date";  


}
