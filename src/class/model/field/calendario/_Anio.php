<?php

require_once("class/model/Field.php");

class _FieldCalendarioAnio extends Field {

  public $type = "year";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = true;
  public $default = null;
  public $length = false;
  public $main = false;
  public $name = "anio";
  public $alias = "ani";


  public function getEntity(){ return $this->container->getEntity('calendario'); }


}
