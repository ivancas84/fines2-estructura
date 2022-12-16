<?php

set_time_limit(0);  
require_once("controller/Base.php");
require_once("function/array_group_value.php");
require_once("function/array_combine_key.php");


class CalificacionesCursoScript extends BaseController{
 /**
   * Formulario para cargar calificaciones
   * ./script/calificacion_form
   */

  public function main(){
    $headers = (isset($_GET["headers"]))? $_GET["headers"] : "persona-apellidos, persona-nombres, persona-numero_documento, nota_final, crec, observaciones"; 
    require_once("script/CalificacionesCurso.html");
  }
}