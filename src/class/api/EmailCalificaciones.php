<?php


require_once("class/api/Base.php");
require_once("function/php_input.php");

class EmailCalificacionesApi extends BaseApi {

  public function main() {
    $data = php_input(); 
    /**
     * id:persona.id
     */
    $return = $this->container->getController("email_calificaciones")->main($data["id"]);
    return $return;
  }
}

