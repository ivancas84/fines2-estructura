<?php

require_once("class/model/Field.php");

class _FieldDesignacionDesde extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $default = null;
  public $length = false;  
  public $name = "desde";
  public $alias = "des";
  public $entityName = "designacion";


}
