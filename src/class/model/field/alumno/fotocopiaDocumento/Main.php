<?php

require_once("class/model/Field.php");

class FieldAlumnoFotocopiaDocumentoMain extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "1";
  public $main = false;
  public $name = "fotocopia_documento";
  public $alias = "fd";


  public function getEntity(){ return new AlumnoEntity; }


}
