<?php

require_once("class/model/Field.php");

class _FieldDetallePersonaPersona extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "persona";
  public $alias = "per";


  public function getEntity(){ return $this->container->getEntity('detalle_persona'); }

  public function getEntityRef(){ return $this->container->getEntity('persona'); }


}
