<?php

class TomaInscripcionPersistSql  {
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
        $toma = $this->container->value("toma")->_call("setDefault");
        $toma->_set("id",uniqid());
        $toma->_set("curso",$data["curso"]);
        $toma->_set("estado","Pendiente");
        $toma->_fastSet("fecha_toma",new DateTime());
        $toma->_set("docente",$data["persona"]);
        $toma->_set("tipo_movimiento","AI");
        $toma->_set("estado_contralor","Pasar");
        $toma->_call("reset")->_call("check");
        if($toma->logs->isError()) throw new Exception($toma->logs->toString());
        $sql = $this->container->persist($this->entityName)->insert($toma->_toArray("sql"));
        return["id" => $toma->_get("id"),"sql"=>$sql];
    }
}
