<?php


require_once("class/controller/Persist.php");
require_once("class/model/Ma.php");
require_once("class/model/Values.php");
require_once("class/controller/persist/ComisionCursos.php");
require_once("class/controller/ModelTools.php");

class ComisionesSiguientesGrupoPersist extends Persist {
  /**
   * Persistencia de cursos y comisiones para un cierto grupo autorizado
   */

  protected $grupo;
  /**
   * grupo al que se definiran las comisiones
   */

  protected $comisionesAnteriores;
  /**
   * comisiones anteriores con las cuales se realizara la definicion del nuevo grupo
   * se obtienen solo las comisiones autorizadas
   */

  public function main($grupo){
    if(empty($grupo["fecha_anio"])) throw new Exception("Dato no definido: fecha anio");
    if(empty($grupo["fecha_semestre"])) throw new Exception("Dato no definido: fecha semestre");
    if(empty($grupo["modalidad"])) throw new Exception("Dato no definido: modalidad");
    if(empty($grupo["sed_centro_educativo"])) throw new Exception("Dato no definido: centro educativo");
    $this->grupo = $grupo;
   
    $this->checkComisionesGrupo();
    $this->getComisionesGrupoAnterior();
    
    foreach($this->comisionesAnteriores as $comision){
      $nuevaComision = EntityValues::getInstanceRequire("comision");
      $nuevaComision->_fromArray($comision);
      $nuevaComision->setApertura(false);
      $nuevaComision->setId(null);
      $nuevaComision->setFechaAnio($grupo["fecha_anio"]);
      $nuevaComision->setFechaSemestre($grupo["fecha_semestre"]);
      $nuevaComision->resetTramoSiguiente();
      if($nuevaComision->_logs()->isError()) continue;

      $controller = new ComisionCursosPersist();
      $comision["comision_siguiente"] = $controller->main($nuevaComision->_toArray());
      array_push($this->logs, ["sql"=>$controller->getEntitySqlo(), "detail"=>$controller->getDetail()]);
      $this->update("comision", $comision);
    }
  }

  public function checkComisionesGrupo(){
    $render = EntityRender::getInstanceParams($this->grupo);
    $render->addCondition(["autorizada","=",true]);
    if(Ma::count("comision",$render)) throw new Exception("Ya existen comisiones para el grupo: " . implode(" " , $this->grupo));
  }

  public function getComisionesGrupoAnterior(){
    $grupoAnterior = ModelTools::intervaloAnterior($this->grupo);
    $render = EntityRender::getInstanceParams($grupoAnterior);
    $render->addCondition(["autorizada","=",true]);
    //$render->addCondition(["anio","=",true]);
    $this->comisionesAnteriores = Ma::all("comision",$render);
    if(!count($this->comisionesAnteriores)) throw new Exception("No existen comisiones anteriores del grupo: " . implode(" " , $this->grupo));
  }


  


}




