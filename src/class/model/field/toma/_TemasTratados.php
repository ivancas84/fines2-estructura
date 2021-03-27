<?php

require_once("class/model/Field.php");

class _FieldTomaTemasTratados extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "temas_tratados";
  public $alias = "tt";
  public $entityName = "toma";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
