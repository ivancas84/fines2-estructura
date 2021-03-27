<?php

require_once("class/model/Field.php");

class _FieldCalendarioAnio extends Field {

  public $type = "year";
  public $fieldType = "nf";
  public $default = null;
  public $name = "anio";
  public $alias = "ani";
  public $entityName = "calendario";
  public $dataType = "year";  
  public $subtype = "year";  


}
