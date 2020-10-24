<?php

require_once("class/model/entity/_Plan.php");

class PlanEntity extends _PlanEntity  {
 
  public $main = ["orientacion", "distribucion_horaria"];
  public $uniqueMultiple = ["orientacion", "distribucion_horaria"];
  
}
