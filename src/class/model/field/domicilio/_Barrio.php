<?php

require_once("class/model/Field.php");

class _FieldDomicilioBarrio extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "255";  
  public $name = "barrio";
  public $alias = "bar";
  public $entityName = "domicilio";


}
