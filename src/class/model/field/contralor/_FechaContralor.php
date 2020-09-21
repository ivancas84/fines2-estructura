<?php

require_once("class/model/Field.php");

class _FieldContralorFechaContralor extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = null;
  public $length = false;
  public $main = false;
  public $name = "fecha_contralor";
  public $alias = "fc";


  public function getEntity(){ return $this->container->getEntity('contralor'); }


}
