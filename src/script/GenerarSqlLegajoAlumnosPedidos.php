<?php

set_time_limit(0);  
require_once("controller/base.php");
// require_once("function/array_group_value.php");
// require_once("function/array_combine_key.php");


class GenerarHorariosComisionesSiguientesScript extends BaseController{
 /**
  * Generar SQL para insertar en el sistema de pedidos
  */
  
  public function main(){

    $idComision = $_GET["comision"];

    $render = $this->container->getEntityRender("alumno_comision");
    $render->setSize(0);
    $render->setCondition(["comision","=",$idComision]);
    
    $alumnoComision_ = $this->container->db()->all("alumno_comision",$render);
    

  }
  

}
