<?php

require_once("class/model/Field.php");

class _FieldDesignacionHasta extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $default = null;
  public $length = false;  
  public $name = "hasta";
  public $alias = "has";
  public $entityName = "designacion";


}
