<?php

require_once("class/api/Base.php");
require_once("class/tools/Filter.php");

class EmailConfirmacionBaseApi {

  public function main() {
    $idToma = Filter::jsonPostRequired(); //siempre deben recibirse ids
    $return = $this->container->getControllerEntity("email", "confirmacion")->main($idToma);
    return $return;
  }

}

