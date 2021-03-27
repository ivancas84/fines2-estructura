<?php

require_once("class/api/Count.php");
require_once("class/model/Render.php");
require_once("function/php_input.php");

class DocenteCountApi extends CountApi {

  public function main() {
    $this->container->getAuth()->authorize($this->entityName, $this->permission);
    $display = php_input();

    $render = Render::getInstanceDisplay($display);

    $render->addPrefix("doc-");
    $render->setFields(["docente"]);
    $render->addCondition(["docente","=",true]);
    $render->setSize(0);

    $tomas = $this->container->getDb()->advanced("toma",$render);
    return count($tomas);
  }

}
