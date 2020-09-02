<?php

require_once("class/model/Field.php");

class _FieldTomaDocente extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = false;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "docente";
  public $alias = "doc";


  public function getEntity(){ return $this->container->getEntity('toma'); }

  public function getEntityRef(){ return $this->container->getEntity('persona'); }


}
