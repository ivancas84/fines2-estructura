<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class ReferenteEntityMain extends Entity {
  public $name = "referente";
  public $alias = "refe";
 
  public function getPk(){
    return new FieldReferenteId;
  }

  public function getFieldsNf(){
    return array(
      new FieldReferenteAlta,
      new FieldReferenteBaja,
    );
  }

  public function getFieldsMu(){
    return array(
      new FieldReferentePersona,
      new FieldReferenteSede,
    );
  }


}
