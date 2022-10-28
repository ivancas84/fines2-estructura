<?php

require_once("api/Base.php");
require_once("controller/ModelTools.php");
require_once("function/php_input.php");

class CursoTomaActivaInfoApi extends BaseApi {
  public $entityName = "curso";
  public $permission = "r";

  public function main() {
    $idCursos = php_input();
    return  $this->container->controller_("model_tools")->cursosConTomaActiva($idCursos);
  }
}

