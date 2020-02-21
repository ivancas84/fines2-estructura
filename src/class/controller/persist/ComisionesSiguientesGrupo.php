<?php


require_once("class/controller/Persist.php");
require_once("class/model/Ma.php");
require_once("class/model/Values.php");
require_once("class/controller/persist/ComisionCursos.php");
require_once("class/controller/ModelTools.php");

class ComisionesSiguientesGrupoPersist extends Persist {
  /**
   * Persistencia de cursos y comisiones
   */
  public function checkComisionesGrupo($grupo){
    $render = Render::getInstanceParams($grupo);
    if(Ma::count("comision",$render)) throw new Exception("Ya existen comisiones para los parametros ingresados");
  }

  public function getComisionesGrupoAnterior($grupoAnterior){
    $render = Render::getInstanceParams($grupoAnterior);
    $this->comisionAnterior_ = Ma::all("comision",$render);
    if(!count($this->comisionAnterior_)) throw new Exception("No existen comisiones anteriores para tomar de referencia");
  }


  public function main($grupo){
     /**
     * @param $data["fecha_anio"] //fecha anio a calcular
     * @param $data["fecha_semestre"] //fecha semestre a calcular
     * @param $data["modalidad"] //modalidad a calcular
     */
    if(empty($grupo["fecha_anio"])) throw new Exception("Dato no definido: fecha anio");
    if(empty($grupo["fecha_semestre"])) throw new Exception("Dato no definido: fecha semestre");
    if(empty($grupo["modalidad"])) throw new Exception("Dato no definido: modalidad");
    if(empty($grupo["sed_centro_educativo"])) throw new Exception("Dato no definido: centro educativo");
   
    $this->checkComisionesGrupo($grupo);
    $grupoAnterior = ModelTools::intervaloAnterior($grupo);
    $this->getComisionesGrupoAnterior($grupoAnterior);
    
    foreach($this->comisionAnterior_ as $comision){
      $nuevaComision = EntityValues::getInstanceRequire("comision");
      $nuevaComision->_fromArray($comision);
      $nuevaComision->setId(null);
      $nuevaComision->setFechaAnio($grupo["fecha_anio"]);
      $nuevaComision->setFechaSemestre($grupo["fecha_semestre"]);
      $nuevaComision->resetTramoSiguiente();
      if($nuevaComision->_logs()->isError()) continue;

      $controller = new ComisionCursosPersist();
      $comision["comision_siguiente"] = $controller->main($nuevaComision->_toArray());
      array_push($this->logs, ["sql"=>$controller->getSql(), "detail"=>$controller->getDetail()]);
      $this->update("comision", $comision);
    }
  
  }


}




