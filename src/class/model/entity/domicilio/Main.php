<?php

require_once("class/model/Entity.php");
require_once("config/entityClasses.php");

class DomicilioEntityMain extends Entity {
  public $name = "domicilio";
  public $alias = "domi";
 
  public function getPk(){
    return new FieldDomicilioId;
  }

  public function getFieldsNf(){
    return array(
      new FieldDomicilioCalle,
      new FieldDomicilioEntre,
      new FieldDomicilioNumero,
      new FieldDomicilioPiso,
      new FieldDomicilioDepartamento,
      new FieldDomicilioBarrio,
      new FieldDomicilioLocalidad,
    );
  }


}
