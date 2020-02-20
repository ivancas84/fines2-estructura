<?php


require_once("class/controller/Persist.php");
require_once("class/model/Ma.php");
require_once("class/model/Values.php");
require_once("class/controller/persist/ComisionCursos.php");
require_once("class/controller/ModelTools.php");
require_once("class/model/Render.php");




class HorariosCursosGrupoPersist extends Persist {
  /**
   * si una comision es siguiente de mas de una comision, no se define el horario
   * si una comision ya tiene el horario definido, no se define el horario
   */

  /**
   * Define los horarios de todos los cursos de un grupo basandose en la comisión anterior
   * En el caso de que encuenrtre un horario definido de al menos un curso ignora toda la comision
   */
  protected $comisionesGrupoAnterior;
  
  protected function consultarComisionesGrupoAnteriorConSiguiente($grupo){
    $grupoAnterior = ModelTools::intervaloAnterior($grupo);
    $render = Render::getInstanceParams($grupoAnterior);
    $render->addCondition(["comision_siguiente","=",true]);
    $this->comisionesGrupoAnterior = Ma::all("comision",$render);
  }

  protected function quitarComisionesGrupoAnteriorMismoSiguiente(){
    $contadorComisionSiguiente = [];
    $idsComisionSiguienteMultiple = [];

    foreach($this->comisionesGrupoAnterior as $comision){
      if (!key_exists($comision["comision_siguiente"], $contadorComisionSiguiente))
        $contadorComisionSiguiente[$comision["comision_siguiente"]] = 0;
      $contadorComisionSiguiente[$comision["comision_siguiente"]]++;
      if($contadorComisionSiguiente[$comision["comision_siguiente"]] > 1)
        array_push($idsComisionSiguienteMultiple, $comision["comision_siguiente"]);
    }

    
    if(!empty($idsComisionSiguienteMultiple)){
      $idsComisionSiguienteMultiple = array_unique($idsComisionSiguienteMultiple);
      for($i = 0; $i < count($this->comisionesGrupoAnterior); $i++){
        if(in_array($this->comisionesGrupoAnterior[$i]["comision_siguiente"], $idsComisionSiguienteMultiple))
          unset($this->comisionesGrupoAnterior[$i]);
      }

      $this->comisionesGrupoAnterior = array_values($this->comisionesGrupoAnterior);
    }

  }

  protected  function quitarComisionesGrupoAnteriorSinHorario(){
    $idsComisionesGrupoAnterior = array_column($this->comisionesGrupoAnterior, "id");
    $horariosGrupoAnterior = Ma::all("horario",["cur_comision","=",$idsComisionesGrupoAnterior]);

    $idsComisionesGrupoAnterior = array_column($this->comisionesGrupoAnterior, "id");
    $idComisionesGrupoAnteriorConHorarios = array_values(array_unique(array_column($horariosGrupoAnterior, "cur_comision")));
    for($i = 0; $i < count($idsComisionesGrupoAnterior); $i++) {
      if(!in_array($idsComisionesGrupoAnterior[$i], $idComisionesGrupoAnteriorConHorarios)){
        unset($this->comisionesGrupoAnterior[$i]);
      }
    }
  }

  protected  function quitarComisionesGrupoAnteriorConHorarioGrupoActual(){
    $idsComisionesGrupoActual = array_column($this->comisionesGrupoAnterior, "comision_siguiente");
    $horariosGrupoActual = Ma::all("horario",["cur_comision","=",$idsComisionesGrupoActual]);

    $idComisionesGrupoActualConHorarios = array_values(array_unique(array_column($horariosGrupoActual, "cur_comision")));
    for($i = 0; $i < count($idsComisionesGrupoActual); $i++) {
      if(in_array($idsComisionesGrupoActual[$i], $idComisionesGrupoActualConHorarios)){
        unset($this->comisionesGrupoAnterior[$i]);
      }
    }
  }


  public function main($grupo){
    if(empty($grupo["fecha_anio"])) throw new Exception("Dato no definido: fecha anio");
    if(empty($grupo["fecha_semestre"])) throw new Exception("Dato no definido: fecha semestre");
    if(empty($grupo["modalidad"])) throw new Exception("Dato no definido: modalidad");
    if(empty($grupo["sed_centro_educativo"])) throw new Exception("Dato no definido: centro educativo (sed_centro_educativo)");
       
    $this->consultarComisionesGrupoAnteriorConSiguiente($grupo);
    
    $this->quitarComisionesGrupoAnteriorMismoSiguiente();
    
    $this->quitarComisionesGrupoAnteriorSinHorario();
    
    $this->quitarComisionesGrupoAnteriorConHorarioGrupoActual();

    foreach($this->comisionesGrupoAnterior as $comision){



    }

    

  }


  
    


}




