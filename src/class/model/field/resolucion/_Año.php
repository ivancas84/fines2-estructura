<?php

require_once("class/model/Field.php");

class _FieldResolucionAño extends Field {

  public $type = "year";
  public $fieldType = "nf";
  public $default = null;
  public $name = "año";
  public $alias = "añ";
  public $entityName = "resolucion";
  public $dataType = "year";  
  public $subtype = "year";  


}
