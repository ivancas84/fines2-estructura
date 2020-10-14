<?php


class TomaPosesionPersistSql  {
  /**
   * Toma posesion realizada por los docentes
   */

  public $entityName;
  public $controller;
  
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
    $sqlo = $this->container->getSqlo("toma");
    $sql = $this->container->getSqlo("toma")->insert($toma->_toArray("sql"));
    return["id" => $toma->id(),"sql"=>$sql];
  }
}
