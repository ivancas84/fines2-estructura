<?php

require_once("class/model/Field.php");

class _FieldCalendarioAnio extends Field {

  public $type = "year";
  public $fieldType = "nf";
  public $default = null;
  public $length = false;  
  public $name = "anio";
  public $alias = "ani";
  public $entityName = "calendario";


}
