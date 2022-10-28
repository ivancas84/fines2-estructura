<?php

/**
 * CONSIDERACIONES
 * no se procesaran las personas sin dni ya que no puede asignarse la trayectoria
 * si existe mas de una inscripcion por alumno solo se procesara la primera, ignorando la segunda
 * si se vuelve a cargar el mismo archivo (respetando los parámetros), se actualizaran los datos. Con esto se da la posibilidad de correjir los errores en el csv y volverlo a cargar.
 */
set_time_limit(0);  
require_once("controller/Base.php");
require_once("function/settypebool.php");

class AlumnosComisionProcesarScript extends BaseController{
 

  public function main(){
    $import = $this->container->getImport("alumnos_comision");
    $import->headers = array_map('trim', explode(",",$_REQUEST["headers"])); //encabezados a procesar
    $import->anio = $_REQUEST["anio"];
    $import->semestre = $_REQUEST["semestre"];
    $import->source = $_REQUEST["source"]; //informacion a procesar
    $import->idComision = $_REQUEST["id_comision"];
    $import->main();
    if(settypebool($_REQUEST["persist"])) $import->persist();
    // echo "<pre>";
    // print_r($import);
    $import->summary();
  }    
 
}
