<?php

/**
 * CONSIDERACIONES
 * no se procesaran las personas sin dni ya que no puede asignarse la trayectoria
 * si existe mas de una inscripcion por alumno solo se procesara la primera, ignorando la segunda
 * si se vuelve a cargar el mismo archivo (respetando los parámetros), se actualizaran los datos. Con esto se da la posibilidad de correjir los errores en el csv y volverlo a cargar.
 */
set_time_limit(0);  
require_once("class/script/Base.php");

class PruebaCalificacionesTramoScript extends BaseScript{
 

  public function main(){
    $return = $this->container->getController("cantidad_asignaturas_aprobadas_alumnos_tramo")->main(["607d89d0817e9"]);
    return $return;
  }    
 
}
