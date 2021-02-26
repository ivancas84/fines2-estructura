<?php

require_once("class/model/Field.php");

class _FieldSedeFechaTraspaso extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $default = null;
  public $name = "fecha_traspaso";
  public $alias = "ft";
  public $entityName = "sede";
  public $dataType = "date";  
  public $subtype = "date";  


}
