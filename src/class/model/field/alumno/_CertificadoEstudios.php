<?php

require_once("class/model/Field.php");

class _FieldAlumnoCertificadoEstudios extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $default = null;
  public $name = "certificado_estudios";
  public $alias = "ce";
  public $entityName = "alumno";
  public $entityRefName = "file";  
  public $dataType = "string";  
  public $subtype = "typeahead";  
  public $length = "45";  


}
