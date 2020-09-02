<?php

require_once("class/model/Entity.php");
require_once("class/model/Field.php");

class _PersonaEntity extends Entity {
  public $name = "persona";
  public $alias = "pers";
 
  public function getPk(){
    return $this->container->getField("persona", "id");
  }

  public function getFieldsNf(){
    return array(
      $this->container->getField("persona", "nombres"),
      $this->container->getField("persona", "apellidos"),
      $this->container->getField("persona", "fecha_nacimiento"),
      $this->container->getField("persona", "numero_documento"),
      $this->container->getField("persona", "cuil"),
      $this->container->getField("persona", "genero"),
      $this->container->getField("persona", "apodo"),
      $this->container->getField("persona", "telefono"),
      $this->container->getField("persona", "email"),
      $this->container->getField("persona", "alta"),
    );
  }

  public function getFieldsMu(){
    return array(
      $this->container->getField("persona", "domicilio"),
    );
  }


}
