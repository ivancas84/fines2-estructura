<?php

set_time_limit(0);  
require_once("class/controller/Base.php");
require_once("function/array_group_value.php");
require_once("function/array_combine_key.php");


class PruebaDisposicionesAprobadasComisionScript extends BaseController{
 /**
   * Formulario para cargar calificaciones
   * ./script/calificacion_form
   */

  public function main(){

    $idComision = $_GET["id_comision"];

    print_r( $this->container->getController("disposiciones_aprobadas_comision")->main($idComision));
    
  }
}