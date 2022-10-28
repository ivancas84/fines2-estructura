<?php


require_once("class/api/Base.php");
require_once("function/php_input.php");

class EmailConfirmacionApi extends BaseApi {

  public function main() {
    $data = php_input();
    $return = $this->container->getController("email_confirmacion")->main($data["id"]);
    return $return;
  }
}

