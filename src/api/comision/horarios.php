<?php

require_once("api/Base.php");

require_once("function/php_input.php");


class ComisionHorariosApi extends BaseApi {
  public $entityName = "comision";

  public function main() {
    $ids = php_input();
    return $this->container->controller_("model_tools")->diasHorariosComision($ids);
  }

}

