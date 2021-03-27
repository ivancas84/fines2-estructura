<?php

require_once("class/model/Field.php");

class _FieldAlumnoCertificadoEstudios extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "certificado_estudios";
  public $alias = "ce";
  public $entityName = "alumno";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
