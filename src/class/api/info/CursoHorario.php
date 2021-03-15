<?php

require_once("class/api/Base.php");
require_once("class/controller/ModelTools.php");
require_once("function/php_input.php");

class CursoHorarioInfoApi extends BaseApi {
  public $entityName = "curso";
  public $permission = "r";

  public function main() {
    $idCursos = php_input();
    return  $this->container->getController("model_tools")->cursoHorario($idCursos);

  }
}

