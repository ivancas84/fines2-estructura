<?php

require_once("api/base.php");
require_once("controller/ModelTools.php");
require_once("function/php_input.php");

class SedeReferentesApi  extends BaseApi {
  public $permission = "r";

  public function main() {
    $ids = php_input();
    return $this->container->controller("referentes","sede")->nombre_telefono($ids);
    
  }
}

