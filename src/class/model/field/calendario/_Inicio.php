<?php

require_once("class/model/Field.php");

class _FieldCalendarioInicio extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $default = null;
  public $length = false;  
  public $name = "inicio";
  public $alias = "ini";
  public $entityName = "calendario";


}
