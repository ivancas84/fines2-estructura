<?php

require_once("api/base.php");
require_once("function/php_input.php");

class CursoHorarioApi extends BaseApi {
  public $entity_name = "curso";
  public $permission = "r";

  public function main() {
    $idCursos = php_input();
    return  $this->container->controller_("model_tools")->cursoHorario($idCursos);
  }
}

