<?php

require_once("class/model/Field.php");

class FieldClasificacionPlanClasificacionMain extends Field {

  public $type = "bigint";
  public $fieldType = "mu";
  public $unique = false;
  public $notNull = true;
  public $default = false;
  public $length = "20";
  public $main = false;
  public $name = "clasificacion";
  public $alias = "cla";


  public function getEntity(){ return new ClasificacionPlanEntity; }

  public function getEntityRef(){ return new ClasificacionEntity; }


}
