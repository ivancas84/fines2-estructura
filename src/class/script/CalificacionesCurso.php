<?php

set_time_limit(0);  
require_once("class/controller/Base.php");
require_once("function/array_group_value.php");
require_once("function/array_combine_key.php");


class CalificacionesCursoScript extends BaseController{
 /**
   * Formulario para cargar calificaciones
   * ./script/calificacion_form
   */

  public function main(){
    $headers = (isset($_GET["headers"]))? $_GET["headers"] : "per_apellidos, per_nombres, per_numero_documento, nota_final, crec, observaciones"; 
    require_once("class/script/CalificacionesCurso.html");
  }
}