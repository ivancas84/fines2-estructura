<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _DetallePersonaEntity extends Entity {
  public $name = "detalle_persona";
  public $alias = "dp";
 
  public function getPk(){
    return $this->container->getField("detalle_persona", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("detalle_persona", "descripcion"),
      $this->container->getField("detalle_persona", "creado"),
    );
  }

  public function getFieldsMu(){
    return array(
      $this->container->getField("detalle_persona", "archivo"),
      $this->container->getField("detalle_persona", "persona"),
    );
  }


}
