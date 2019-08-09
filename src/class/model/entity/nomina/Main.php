<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class NominaEntityMain extends Entity {
  public $name = "nomina";
  public $alias = "nomi";
 
  public function getPk(){
    return new FieldNominaId;
  }

  public function getFieldsNf(){
    return array(
      new FieldNominaAlta,
      new FieldNominaActivo,
    );
  }

  public function getFieldsMu(){
    return array(
      new FieldNominaDivision,
      new FieldNominaPersona,
    );
  }


}
