<?php


require_once("class/controller/Persist.php");
require_once("class/controller/persist/HorariosComision.php");
require_once("class/model/Ma.php");
require_once("class/model/Values.php");
require_once("class/controller/ModelTools.php");
require_once("class/model/Render.php");
require_once("function/array_combine_key.php");




class HorariosComisionesGrupoPersist extends Persist {
  /**
   * Definir horarios de todos los cursos de un grupo basandose en la comision anterior
   * 
   * si una comision es siguiente de mas de una comision, no se define el horario
   * si una comision ya tiene el horario definido, no se define el horario
   * si el horario de al menos un curso está definido, se ignora toda la comision
   */
  protected $comisionesAnteriores;
  protected $diasHorarios;


  public function main($grupo){
    if(empty($grupo["fecha_anio"])) throw new Exception("Dato no definido: fecha anio");
    if(empty($grupo["fecha_semestre"])) throw new Exception("Dato no definido: fecha semestre");
    if(empty($grupo["modalidad"])) throw new Exception("Dato no definido: modalidad");
    if(empty($grupo["sed_centro_educativo"])) throw new Exception("Dato no definido: centro educativo (sed_centro_educativo)");
       
    $this->consultarComisionesAnterioresConSiguiente($grupo);
    
    $this->quitarComisionesAnterioresMismoSiguiente();
    
    $this->quitarComisionesAnterioresSinHorario();
    
    $this->quitarComisionesAnterioresConHorarioGrupoActual();

    $this->definirDiasHorariosComisionesAnteriores();

    $this->definirHorariosComisiones();
  }
  
  protected function consultarComisionesAnterioresConSiguiente($grupo){
    $grupoAnterior = ModelTools::intervaloAnterior($grupo);
    $render = Render::getInstanceParams($grupoAnterior);
    $render->addCondition(["comision_siguiente","=",true]);
    $this->comisionesAnteriores = Ma::all("comision",$render);
  }

  protected function quitarComisionesAnterioresMismoSiguiente() {
    $contadorComisionSiguiente = [];
    $idsComisionSiguienteMultiple = [];

    foreach($this->comisionesAnteriores as $comision){
      if (!key_exists($comision["comision_siguiente"], $contadorComisionSiguiente))
        $contadorComisionSiguiente[$comision["comision_siguiente"]] = 0;
      $contadorComisionSiguiente[$comision["comision_siguiente"]]++;
      if($contadorComisionSiguiente[$comision["comision_siguiente"]] > 1)
        array_push($idsComisionSiguienteMultiple, $comision["comision_siguiente"]);
    }

    if(!empty($idsComisionSiguienteMultiple)){
      $idsComisionSiguienteMultiple = array_unique($idsComisionSiguienteMultiple);
      for($i = 0; $i < count($this->comisionesAnteriores); $i++){
        if(in_array($this->comisionesAnteriores[$i]["comision_siguiente"], $idsComisionSiguienteMultiple))
          unset($this->comisionesAnteriores[$i]);
      }

      $this->comisionesAnteriores = array_values($this->comisionesAnteriores);
    }
  }

  protected  function quitarComisionesAnterioresSinHorario(){
    $idsComisionesAnteriores = array_column($this->comisionesAnteriores, "id");
    $horariosGrupoAnterior = Ma::all("horario",["cur_comision","=",$idsComisionesAnteriores]);

    $idsComisionesAnteriores = array_column($this->comisionesAnteriores, "id");
    $idComisionesAnterioresConHorarios = array_values(array_unique(array_column($horariosGrupoAnterior, "cur_comision")));
    for($i = 0; $i < count($idsComisionesAnteriores); $i++) {
      if(!in_array($idsComisionesAnteriores[$i], $idComisionesAnterioresConHorarios)){
        unset($this->comisionesAnteriores[$i]);
      }
    }
  }

  protected  function quitarComisionesAnterioresConHorarioGrupoActual(){
    $idsComisionesGrupoActual = array_column($this->comisionesAnteriores, "comision_siguiente");
    $horariosGrupoActual = Ma::all("horario",["cur_comision","=",$idsComisionesGrupoActual]);

    $idComisionesGrupoActualConHorarios = array_values(array_unique(array_column($horariosGrupoActual, "cur_comision")));
    for($i = 0; $i < count($idsComisionesGrupoActual); $i++) {
      if(in_array($idsComisionesGrupoActual[$i], $idComisionesGrupoActualConHorarios)){
        unset($this->comisionesAnteriores[$i]);
      }
    }
  }

  protected function definirDiasHorariosComisionesAnteriores (){
    $ids = array_column($this->comisionesAnteriores, "id");
    $diasHorarios = ModelTools::diasHorariosComision($ids);
    $this->diasHorarios = array_combine_key($diasHorarios, "comision");
  }

  protected function definirHorariosComisiones(){
    
    $controller = new HorariosComisionPersist();

    foreach($this->comisionesAnteriores as $comision){
      $dias = $this->diasHorarios[$comision["id"]]["dias_ids"];
      $hora_inicio = $this->diasHorarios[$comision["id"]]["hora_inicio"];
      $data = [
        "id" => $comision["comision_siguiente"],
        "dias" => explode(",",$dias),
        "hora_inicio" => $hora_inicio
      ];

      $controller->main($data);
    }

    array_push($this->logs, ["sql"=>$controller->getSql(), "detail"=>$controller->getDetail()]);
  }


}




