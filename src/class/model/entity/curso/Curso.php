<?php

require_once("class/model/entity/curso/Main.php");

class CursoEntity extends CursoEntityMain {
  public function getFieldsNf(){
    $array = parent::getFieldsNf();
    array_push($array, Field::getInstanceRequire("curso","horario"));
    return $array;
  }

}
