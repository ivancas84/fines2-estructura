<?php


require_once("class/controller/Persist.php");
require_once("class/model/Ma.php");


class ComisionesSiguientesPersist extends Persist {
  /**
   * Persistencia de cursos y comisiones
   */

  public function consultarComisiones(array $p){
    /**
     * Si existe al menos una comision para los parametros indicados no se realiza la consulta
     */
    $render = [
      ["fecha_anio", "=", $p["fecha_anio"]],
      ["fecha_semestre", "=", $p["fecha_semestre"]],
      ["modalidad", "=", $p["modalidad"]]
    ];

    return Ma::all("comision",$render);
  }

  public function definirParametros($data){
    /**
     * Define los parametros correctos de la consulta de comisiones anteriores a la solicitada
     */
    $param["fecha_anio"] = intval($data["fecha_anio"]);
    $param["fecha_semestre"] = intval($data["fecha_semestre"]);
    $param["modalidad"] = $data["modalidad"];
    
    switch($param["fecha_semestre"]){
      case 2:  
        $param["fecha_semestre"] = 1; 
      break;
      case 1: 
        $param["fecha_anio"]--;
        $param["fecha_semestre"] = 2; 
      break;
      
      default: 
        $param["fecha_semestre"] = false;
        $param["fecha_anio"]--;
    }

    return $param;
  }

  public function main($data){
    /**
     * @param $data["fecha_anio"] //fecha anio a calcular
     * @param $data["fecha_semestre"] //fecha semestre a calcular
     * @param $data["modalidad"] //modalidad a calcular
     */
    if(empty($data["fecha_anio"])) throw new Exception("Dato no definido: fecha anio");
    if(empty($data["fecha_semestre"])) throw new Exception("Dato no definido: fecha semestre");
    if(empty($data["modalidad"])) throw new Exception("Dato no definido: modalidad");

    if(count($this->consultarComisiones($data))) throw new Exception("Ya existen comisiones para los parametros ingresados");
    $param = $this->definirParametros($data);
    $comisionesAnteriores = $this->consultarComisiones($param);
    if(!count($rows)) throw new Exception("No existen comisiones anteriores para tomar de referencia");
  
    foreach($comisionesAnteriores as $comision){
      $nuevaComision = Comision::_fromArray($comision);
      $nuevaComision->setId(null);
      $nuevaComision->setFechaAnio($param["fecha_anio"]);
      $nuevaComision->setFechaSemestre($param["fecha_semestre"]);
      $nuevaComision->resetTramoSiguiente();
      if($nuevaComision->_logs->isError()) {
        
      }
      print_r($nuevaComision->_toArray());
      
    }
  }


}




