<?php

require_once("api/Base.php");
require_once("function/php_input.php");
require_once("function/array_group_value.php");
require_once("function/array_unset_keys.php");
require_once("function/array_combine_key.php");

class CantidadAsignaturasAprobadasAlumnosTramoApi extends BaseApi {
  /**
   * Dado un numero de comision se obtienen los alumnos y la cantidad de asignaturas aprobadas
   */
  public $idAlumno_ = [];

  public function main() {
    $this->container->getAuth()->authorize("alumno", "r");
    $this->idAlumno_ = php_input();
    
    return $this->container->controller_("cantidad_asignaturas_aprobadas_alumnos_tramo")->main($this->idAlumno_);
  }

}
