<?php

require_once("api/Count.php");
require_once("model/EntityRender.php");
require_once("function/php_input.php");

class DocenteCountApi extends CountApi {

  public function main() {
    $this->container->getAuth()->authorize($this->entityName, $this->permission);
    $display = php_input();

    $render = EntityRender::getInstanceDisplay($display);

    $render->addPrefix("doc-");
    $render->setFields(["docente"]);
    $render->addCondition(["docente","=",true]);
    $render->setSize(0);

    $tomas = $this->container->db()->advanced("toma",$render);
    return count($tomas);
  }

}
