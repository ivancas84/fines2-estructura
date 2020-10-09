<?php

require_once("class/controller/Base.php");

class TomaPosesionPersistSql extends Base {
  /**
   * Toma posesion realizada por los docentes
   */

  public function main($data) {
    /**
     * $data["persona"] Id de la persona
     * $data["curso"] Id del curso
     */
    $toma = $this->container->getValue("toma")->_call("setDefault");
    $toma->setId(uniqid());
    $toma->setCurso($data["curso"]);
    $toma->setEstado("Pendiente");
    $toma->_setFechaToma(new DateTime());
    $toma->setDocente($data["persona"]);
    $toma->setTipoMovimiento("AI");
    $toma->setEstadoContralor("Pasar");
    $sql = $this->container->getSqlo("toma")->insert($toma->_toArray("sql"));
    return["id" => $toma->id(),"sql"=>$sql];
  }
}
