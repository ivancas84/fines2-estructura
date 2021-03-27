<?php

require_once("function/php_input.php");

class EmailConfirmacionInfoApi {

  public function main() {
    $data = php_input();
    $return = $this->container->getControllerEntity("email", "confirmacion")->main($data["id"]);
    return $return;
  }
}

