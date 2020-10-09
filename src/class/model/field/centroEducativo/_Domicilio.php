<?php

require_once("class/model/Field.php");

class _FieldCentroEducativoDomicilio extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $length = "45";  
  public $name = "domicilio";
  public $alias = "dom";
  public $entityName = "centro_educativo";
  public $entityRefName = "domicilio";  


}
