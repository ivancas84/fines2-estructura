<?php

require_once("class/model/Field.php");

class _FieldSedeCentroEducativo extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "centro_educativo";
  public $alias = "ce";
  public $entityName = "sede";
  public $entityRefName = "centro_educativo";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  
  public $value = "string";  


}
