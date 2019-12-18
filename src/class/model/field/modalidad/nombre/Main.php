<?php

require_once("class/model/Field.php");

class FieldModalidadNombreMain extends Field {

  public $type = "varchar";
  public $fieldType = "nf";
  public $unique = true;
  public $notNull = true;
  public $default = false;
  public $length = "45";
  public $main = false;
  public $name = "nombre";
  public $alias = "nom";


  public function getEntity(){ return new ModalidadEntity; }


}
