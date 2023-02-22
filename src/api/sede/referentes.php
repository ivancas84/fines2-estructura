<?php

require_once("api/base.php");
require_once("controller/ModelTools.php");
require_once("function/php_input.php");

class SedeReferentesApi  extends BaseApi {
  public $permission = "r";

  public function main() {
    $ids = php_input();
    $render = $this->container->getEntityRender("designacion");
    $render->addCondition(["sede","=",$ids]);
    $render->addCondition(["hasta","=",false]);
    $render->addCondition(["cargo","=","1"]); //referente

    $render->setSize(0);
    $render->setFields([
      "persona", "sede"
    ]);
  }
}

