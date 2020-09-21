<?php

require_once("class/model/Field.php");

class _FieldCalendarioInicio extends Field {

  public $type = "date";
  public $fieldType = "nf";
  public $unique = false;
  public $notNull = false;
  public $default = null;
  public $length = false;
  public $main = false;
  public $name = "inicio";
  public $alias = "ini";


  public function getEntity(){ return $this->container->getEntity('calendario'); }


}
