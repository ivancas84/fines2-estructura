<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _TipoSedeEntity extends Entity {
  public $name = "tipo_sede";
  public $alias = "ts";
 
  public function getPk(){
    return $this->container->getField("tipo_sede", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("tipo_sede", "descripcion"),
    );
  }


}
