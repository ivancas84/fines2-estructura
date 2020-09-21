<?php

require_once("class/model/Field.php");

class _FieldSedeDomicilio extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "domicilio";
  public $alias = "dom";


  public function getEntity(){ return $this->container->getEntity('sede'); }

  public function getEntityRef(){ return $this->container->getEntity('domicilio'); }


}
