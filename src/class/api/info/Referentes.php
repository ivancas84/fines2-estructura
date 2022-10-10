<?php

require_once("class/api/Base.php");
require_once("class/controller/ModelTools.php");
require_once("function/php_input.php");

class ReferentesInfoApi  extends BaseApi {
  public $permission = "r";

  public function main() {
    $ids = php_input();
    $render = $this->container->getRender("designacion");
    $render->addCondition(["sede","=",$ids]);
    $render->addCondition(["hasta","=",false]);
    $render->addCondition(["cargo","=","1"]); //referente

    $render->setSize(0);
    $render->setFields([
      "persona", "sede"
    ]);
  }
}

