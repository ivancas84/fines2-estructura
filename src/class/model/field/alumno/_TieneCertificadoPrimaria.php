<?php

require_once("class/model/Field.php");

class _FieldAlumnoTieneCertificadoPrimaria extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $default = "0";
  public $name = "tiene_certificado_primaria";
  public $alias = "tca";
  public $entityName = "alumno";
  public $dataType = "boolean";  
  public $subtype = "checkbox";  
  public $length = "1";  


}
