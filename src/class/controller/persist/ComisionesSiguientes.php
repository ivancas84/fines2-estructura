<?php


require_once("class/controller/Persist.php");
require_once("class/model/Ma.php");
require_once("class/model/Values.php");
require_once("class/controller/persist/ComisionCursos.php");



class ComisionesSiguientesPersist extends Persist {
  /**
   * Persistencia de cursos y comisiones
   */
  protected $entityName = "comisiones_siguientes";

  public function main($data){
     /**
     * @param $data["fecha_anio"] //fecha anio a calcular
     * @param $data["fecha_semestre"] //fecha semestre a calcular
     * @param $data["modalidad"] //modalidad a calcular
     */
    if(empty($data["fecha_anio"])) throw new Exception("Dato no definido: fecha anio");
    if(empty($data["fecha_semestre"])) throw new Exception("Dato no definido: fecha semestre");
    if(empty($data["modalidad"])) throw new Exception("Dato no definido: modalidad");
    if(empty($data["sed_centro_educativo"])) throw new Exception("Dato no definido: centro educativo");
   
    $render = Render::getInstanceParams($data);
    if(Ma::count("comision",$render)) throw new Exception("Ya existen comisiones para los parametros ingresados");
    
    $dataAnterior = ModelTools::intervaloAnterior($data);
    $render = Render::getInstanceParams($dataAnterior);
    $comisionesAnteriores = Ma::all("comision",$render);
    if(!count($comisionesAnteriores)) throw new Exception("No existen comisiones anteriores para tomar de referencia");
  
    foreach($comisionesAnteriores as $comision){
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
    }
  
  }


}




