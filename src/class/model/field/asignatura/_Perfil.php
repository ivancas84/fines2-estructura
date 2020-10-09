<?php

require_once("class/model/Field.php");

class _FieldAsignaturaPerfil extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $default = null;
  public $length = "45";  
  public $name = "perfil";
  public $alias = "per";
  public $entityName = "asignatura";


}
