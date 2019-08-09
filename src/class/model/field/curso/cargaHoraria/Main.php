<?php

require_once("class/model/Field.php");

class FieldCursoCargaHorariaMain extends Field {

  public $type = "bigint";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "carga_horaria";
  public $alias = "ch";


  public function getEntity(){ return new CursoEntity; }

  public function getEntityRef(){ return new CargaHorariaEntity; }


}
