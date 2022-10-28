<?php

require_once("api/Base.php");
require_once("function/php_input.php");
class CantidadAsignaturasAlumnosApi extends BaseApi {

  public function main() {
    /**
     * Calcula la cantidad de asignaturas aprobadas para un conjunto de alumnos de determinado plan
     * 
     */
    $this->container->getAuth()->authorize($this->entityName, $this->permission);
    $data = php_input();
    /**
     * ids //ids de alumnos
     * plan //plan
     */

    
    $render = $this->container->getEntityRender("calificacion");
    $render->setCondition([
      ["persona","=",$idsPersonas],
      [
        ["nota_final",">=","7"],
        ["crec",">=","4","OR"]
      ]
    ]);

    
    $render->setFields(["persona", ]);
    $render->setGroup(["persona"=>"persona"]);
    
    return $this->container->db()->select("calificacion",$render);
  }

}
