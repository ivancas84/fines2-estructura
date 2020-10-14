<?php

require_once("class/tools/Filter.php");

class EmailConfirmacionInfoApi {

  public function main() {
    
    $data = Filter::jsonPostRequired(); //siempre deben recibirse ids
    $return = $this->container->getControllerEntity("email", "confirmacion")->main($data["id"]);
    return $return;
  }

}

