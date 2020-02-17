<?php


require_once("class/controller/Persist.php");
require_once("class/model/Ma.php");
require_once("class/model/Values.php");
require_once("class/controller/persist/ComisionCursos.php");



class HorariosCursosGrupoPersist extends Persist {
  /**
   * Define los horarios de todos los cursos de un grupo basandose en la comisión anterior
   * En el caso de que encuenrtre un horario definido de al menos un curso ignora toda la comision
   */
  protected $entityName = "horarios_cursos_grupo";


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
     * @param $data["fecha_anio"]
     * @param $data["fecha_semestre"]
     * @param $data["modalidad"]
     * @param $data["centro_educativo"]
     */
    if(empty($data["fecha_anio"])) throw new Exception("Dato no definido: fecha anio");
    if(empty($data["fecha_semestre"])) throw new Exception("Dato no definido: fecha semestre");
    if(empty($data["modalidad"])) throw new Exception("Dato no definido: modalidad");
    if(empty($data["sed_centro_educativo"])) throw new Exception("Dato no definido: centro_educativo");


    //if(!count($this->consultarCursos($data))) throw new Exception("Ya existen comisiones para los parametros ingresados");
    //$param = $this->definirParametros($data);
    $cursos = $this->consultarCursos($data);
    if(!count($cursos)) throw new Exception("No existen cursos");
  
    foreach($cursos as $curso){
      /*
      $nuevaComision = EntityValues::getInstanceRequire("comision");
      $nuevaComision->_fromArray($comision);
      $nuevaComision->setId(null);
      $nuevaComision->setFechaAnio($data["fecha_anio"]);
      $nuevaComision->setFechaSemestre($data["fecha_semestre"]);
      $nuevaComision->resetTramoSiguiente();
      if($nuevaComision->_logs()->isError()) continue;

      $controller = new ComisionCursosPersist();
      $controller->main($nuevaComision->_toArray());
      array_push($this->logs, ["sql"=>$controller->getSql(), "detail"=>$controller->getDetail()]);
      */
    }
  
  }


}




