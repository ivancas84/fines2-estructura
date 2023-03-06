<?php

require_once("api/base.php");

require_once("function/php_input.php");


class ComisionHorariosApi extends BaseApi {
  public $entity_name = "comision";

  public function main() {
    $ids = php_input();
    return $this->container->controller("horarios","comision")->dias_horarios($ids);
  }

}

