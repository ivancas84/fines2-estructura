<?php

set_time_limit(0);  
require_once("controller/Base.php");
require_once("function/array_group_value.php");
require_once("function/array_combine_key.php");

class PruebaAlumnosAprobadosComisionScript extends BaseController{
  /**
   * Formulario para cargar calificaciones
   * ./script/calificacion_form
   */

  public function main(){

    $idComision_ = $_GET["id_comision"];

    $render = $this->container->getEntityRender("comision");
    $render->addCondition(["cal-anio","=","2021"]);
    $idComision_ = $this->container->db()->ids("comision",$render);


    print_r(
      $this->container->controller_("alumnos_aprobados_comision")->main($idComision_)
    );

  }
}