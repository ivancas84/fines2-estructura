<?php

require_once("class/model/Field.php");

class _FieldComisionCalendario extends Field {

  public $type = "varchar";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = "45";
  public $main = false;
  public $name = "calendario";
  public $alias = "cal";


  public function getEntity(){ return $this->container->getEntity('comision'); }

  public function getEntityRef(){ return $this->container->getEntity('calendario'); }


}
