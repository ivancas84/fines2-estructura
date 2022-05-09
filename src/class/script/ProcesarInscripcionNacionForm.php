<?php

set_time_limit(0);  
require_once("class/controller/Base.php");
require_once("function/array_group_value.php");
require_once("function/array_combine_key.php");


class ProcesarInscripcionNacionFormScript extends BaseController{
 /**
   * Formulario para cargar calificaciones
   * ./script/calificacion_form
   */

  public function main(){
    $headers = (isset($_GET["headers"]))? $_GET["headers"] : "per_numero_documento, per_apellidos, per_nombres, per_genero, per_cuil, no_localidad, no_direccion, no_codigo_postal, per_email, per_telefono, no_escuela_fines_partido, no_escuela_fines_localidad, no_escuela_fines_institucion"; 
    require_once("class/script/ProcesarInscripcionNacionForm.html");
  }
}