<?php

require_once("api/Base.php");
require_once("controller/ModelTools.php");



class ComisionCursosHorariosApi extends BaseApi {
  public function main(array $idsComision) {
    return $this->container->controller("cursos_horarios")->main($idsComision);
  }

}

