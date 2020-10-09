<?php

require_once("class/model/Field.php");

class _FieldSedeCentroEducativo extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $length = "45";  
  public $name = "centro_educativo";
  public $alias = "ce";
  public $entityName = "sede";
  public $entityRefName = "centro_educativo";  


}
