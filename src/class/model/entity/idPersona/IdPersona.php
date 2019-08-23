<?php

require_once("class/model/entity/idPersona/Main.php");

class IdPersonaEntity extends IdPersonaEntityMain {

  public function getFieldsNf(){
    $array = parent::getFieldsNf();
    array_push($array, Field::getInstanceRequire("id_persona","telefonos"));
    return $array;
  }
}
