<?php

/**
 * CONSIDERACIONES
 * no se procesaran las personas sin dni ya que no puede asignarse la trayectoria
 * si existe mas de una inscripcion por alumno solo se procesara la primera, ignorando la segunda
 * si se vuelve a cargar el mismo archivo (respetando los parámetros), se actualizaran los datos. Con esto se da la posibilidad de correjir los errores en el csv y volverlo a cargar.
 */
set_time_limit(0);  
require_once("controller/Base.php");

class PruebaEmailInscripcionScript extends BaseController{
 

  public function main(){
    $return = $this->container->controller_("email_inscripcion")->main("3FF");
    return $return;
  }    
 
}
