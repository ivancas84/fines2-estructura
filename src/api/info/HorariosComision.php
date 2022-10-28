<?php

require_once("class/api/Base.php");

require_once("function/php_input.php");


class HorariosComisionInfoApi extends BaseApi {
  public $entityName = "horarios_comision";

  public function main() {
    $ids = php_input();
    return $this->container->getController("model_tools")->diasHorariosComision($ids);
  }

}

