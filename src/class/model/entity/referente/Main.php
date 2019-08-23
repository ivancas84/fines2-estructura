<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class ReferenteEntityMain extends Entity {
  public $name = "referente";
  public $alias = "refe";
 
  public function getPk(){
    return Field::getInstanceRequire("referente", "id");
  }

  public function getFieldsNf(){
    return array(
      Field::getInstanceRequire("referente", "alta"),
      Field::getInstanceRequire("referente", "baja"),
    );
  }

  public function getFieldsMu(){
    return array(
      Field::getInstanceRequire("referente", "persona"),
      Field::getInstanceRequire("referente", "sede"),
    );
  }


}
