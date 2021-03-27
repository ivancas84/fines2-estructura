<?php


require_once("class/controller/HorariosComisionPersist.php");
require_once("class/controller/ModelTools.php");
require_once("function/array_combine_key.php");




class HorariosComisionesGrupoPersist {
  /**
   * Definir horarios de todos los cursos de un grupo basandose en la comision anterior
   * 
   * si una comision es siguiente de mas de una comision, no se define el horario
   * si una comision ya tiene el horario definido, no se define el horario
   * si el horario de al menos un curso está definido, se ignora toda la comision
   */
  protected $comisionesAnteriores;
  protected $diasHorarios;
  protected $mt;

  public function main($grupo){
    $this->mt = new ModelTools();
    $this->mt->container = $this->container;

    if(empty($grupo["cal-anio"])) throw new Exception("Dato no definido: fecha anio");
    if(empty($grupo["cal-semestre"])) throw new Exception("Dato no definido: fecha semestre");
    if(empty($grupo["modalidad"])) throw new Exception("Dato no definido: modalidad");
    //if(empty($grupo["sed-centro_educativo"])) throw new Exception("Dato no definido: centro educativo (sed_centro_educativo)");
       
    $this->consultarComisionesAnterioresConSiguiente($grupo);
    /**
     * Consultar comisiones anteriores dle grupo, que tengan el campo siguiente definido
     */
    $this->quitarComisionesAnterioresMismoSiguiente();
    /**
     * Quitar comisiones que tengan el campo siguiente repetido
     */
    
    $this->quitarComisionesAnterioresSinHorario();
    /**
     * quitar comisiones anteriores que no tengan el horario definido
     */

    $this->quitarComisionesAnterioresConHorarioGrupoActual();

    /**
     *  "quitar comisiones anteriores cuyo horario de la comision siguiente este definido";
     */

    $this->definirDiasHorariosComisionesAnteriores();
    /**
     * obtener dias y horarios de las comisiones anteriores
     */

    return $this->definirHorariosComisiones();
    /**
     * definir dias y horarios para las comisiones actuales
     */
  }
  
  protected function consultarComisionesAnterioresConSiguiente($grupo){
    $grupoAnterior = $this->mt->intervaloAnterior($grupo, "cal-");
    $render = $this->container->getRender("comision");
    $render->setParams($grupoAnterior);
    $render->addCondition(["comision_siguiente","=",true]);
    $render->setSize(0);
    $this->comisionesAnteriores = $this->container->getDb()->all("comision",$render);
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
    $render = $this->container->getRender("horario");
    $render->addCondition(["cur-comision","=",$idsComisionesAnteriores]);
    $render->setSize(0);
    $horariosGrupoAnterior = $this->container->getDb()->all("horario",$render);
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
    $render = $this->container->getRender("horario");
    $render->setCondition(["cur-comision","=",$idsComisionesGrupoActual]);
    $render->setSize(0);
    $horariosGrupoActual = $this->container->getDb()->all("horario",$render);

    $idComisionesGrupoActualConHorarios = array_values(array_unique(array_column($horariosGrupoActual, "cur_comision")));
    for($i = 0; $i < count($idsComisionesGrupoActual); $i++) {
      if(in_array($idsComisionesGrupoActual[$i], $idComisionesGrupoActualConHorarios)){
        unset($this->comisionesAnteriores[$i]);
      }
    }
  }

  protected function definirDiasHorariosComisionesAnteriores (){
    $ids = array_column($this->comisionesAnteriores, "id");
    $diasHorarios = $this->mt->diasHorariosComision($ids);
    $this->diasHorarios = array_combine_key($diasHorarios, "comision");
  }

  protected function definirHorariosComisiones(){
    
    $controller = $this->container->getController("horarios_comision_persist");

    $ids = [];
    $detail = [];
    foreach($this->comisionesAnteriores as $comision){
      $dias = $this->diasHorarios[$comision["id"]]["dias_ids"];
      $hora_inicio = $this->diasHorarios[$comision["id"]]["hora_inicio"];
      $data = [
        "id" => $comision["comision_siguiente"],
        "dias" => explode(",",$dias),
        "hora_inicio" => $hora_inicio
      ];

      $persist = $controller->main($data);
      array_push($ids, $persist["id"]);
      $detail = array_merge($detail,$persist["detail"]);
    }

    return ["ids"=>$ids, "detail"=>$detail];

    //array_push($this->logs, ["sql"=>$controller->getSql(), "detail"=>$controller->getDetail()]);
  }


}




