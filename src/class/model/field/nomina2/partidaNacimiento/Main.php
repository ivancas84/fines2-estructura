<?php

require_once("class/model/Field.php");

class FieldNomina2PartidaNacimientoMain extends Field {

  public $type = "tinyint";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "1";
  public $main = false;
  public $name = "partida_nacimiento";
  public $alias = "pn";


  public function getEntity(){ return new Nomina2Entity; }


}
