<?php

require_once("class/model/Field.php");

class _FieldTomaFechaToma extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $default = null;
  public $length = false;  
  public $name = "fecha_toma";
  public $alias = "ft";
  public $entityName = "toma";


}
