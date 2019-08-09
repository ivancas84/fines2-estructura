<?php

require_once("class/model/entity/curso/Main.php");

class CursoEntity extends CursoEntityMain {

  public function getFieldsNf(){
    $array = parent::getFieldsNf();
    array_push($array, new FieldCursoHorario);
    return $array;
  }

  public function getFieldsFk(){
    $array = parent::getFieldsFk();
    array_push($array, new FieldCursoTomaActiva);
    return $array;
  }

}
