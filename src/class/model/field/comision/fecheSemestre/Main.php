<?php

require_once("class/model/Field.php");

class FieldComisionFecheSemestreMain extends Field {

  public $type = "int";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = false;
  public $length = "10";
  public $main = false;
  public $name = "feche_semestre";
  public $alias = "fs";


  public function getEntity(){ return new ComisionEntity; }


}
