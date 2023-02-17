<?php

require_once("api/Base.php");
require_once("controller/ModelTools.php");



class ComisionCursoHorarioApi extends BaseApi {
  public function main($idComision) {
    return $this->container->controller_("model_tools")->cursosConHorariosDeComision($idComision);
  }

}

