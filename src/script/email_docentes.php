<?php


set_time_limit(0);  
require_once("controller/base.php");
require_once("function/array_group_value.php");
require_once("function/array_combine_key.php");
require_once("function/array_combine_keys.php");


class EmailDocentesScript extends BaseController{
 /**
   * Formulario para cargar calificaciones
   * ./script/calificacion_form
   */

  public function main(){

    $emails = $this->container->query("toma")->cond([
        ["calendario-anio","=","2023"],
        ["calendario-semestre","=","1"],
        ["modalidad-id","=","7"],
        ["comision-autorizada","=",true],
      ])->group(["docente-email"])
      ->field("docente-email")->column();
      echo implode(", ", array_filter(array_merge($emails)));  
  }

  
}
