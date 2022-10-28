<?php


require_once("api/Base.php");
require_once("function/php_input.php");

class EmailInscripcionApi extends BaseApi {

  public function main() {
    $data = php_input(); 
    /**
     * id:persona.id
     */
    $return = $this->container->controller_("email_inscripcion")->main($data["id"]);
    return $return;
  }
}

