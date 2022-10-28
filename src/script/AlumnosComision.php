<?php

set_time_limit(0);  
require_once("controller/Base.php");
require_once("function/array_group_value.php");
require_once("function/array_combine_key.php");


class AlumnosComisionScript extends BaseController{
 /**
   * Formulario para cargar alumnos de comision
   * ./script/calificacion_form
   */

  public function main(){
    $headers = (isset($_GET["headers"]))? $_GET["headers"] : "per_apellidos, per_nombres, per_numero_documento, per_fecha_nacimiento, per_telefono"; 
    require_once("script/AlumnosComision.html");
  }
}