<?php

set_time_limit(0);  
require_once("class/controller/Base.php");
require_once("function/array_group_value.php");
require_once("function/array_combine_key.php");
require_once("function/settypebool.php");

class GenerarHorariosComisionesSiguientesScript extends BaseController{
 /**
   * consultar comisiones anteriores con siguiente
   * quitarComisionesAnterioresMismoSiguiente
   * quitarComisionesAnterioresSinHorario
   * quitarComisionesAnterioresConHorarioGrupoActual
   * quitarComisionesAnterioresConGrupoActualSinAutorizar
   * definirDiasHorariosComisionesAnteriores
   * definirHorariosComisiones
   * 
   * ./script/generar_horarios_comisiones_siguientes
   */
  protected $comisionesAnteriores;
  protected $diasHorarios;
  protected $mt;

  public function main(){

    $grupo = ["cal-anio"=>'2022',"cal-semestre"=>2,"modalidad"=>"1", "sed-centro_educativo"=>"6047d36d50316"];

    $this->mt = $this->container->getController("model_tools");

    if(empty($grupo["cal-anio"])) throw new Exception("Dato no definido: fecha anio");
    if(empty($grupo["cal-semestre"])) throw new Exception("Dato no definido: fecha semestre");
    if(empty($grupo["modalidad"])) throw new Exception("Dato no definido: modalidad");
    if(empty($grupo["sed-centro_educativo"])) throw new Exception("Dato no definido: centro educativo (sed_centro_educativo)");
       
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

    $this->quitarComisionesAnterioresConGrupoActualSinAutorizar();

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

    $this->comisionesAnteriores = array_values($this->comisionesAnteriores);
  }

  protected  function quitarComisionesAnterioresConGrupoActualSinAutorizar(){
    $idsComisionesGrupoActual = array_column($this->comisionesAnteriores, "comision_siguiente");
    $render = $this->container->getRender("comision");
    $render->setSize(0);
    $comision_ = $this->container->getDb()->getAll("comision",$idsComisionesGrupoActual);
    $idComisionesGrupoActualSinAutorizar = [];

    foreach($comision_ as $c){
      if(!settypebool($c["autorizada"])) {
        array_push($idComisionesGrupoActualSinAutorizar, $c["id"]);
      }
    }

    for($i = 0; $i < count($idsComisionesGrupoActual); $i++) {
      if(in_array($idsComisionesGrupoActual[$i], $idComisionesGrupoActualSinAutorizar)){
        unset($this->comisionesAnteriores[$i]);
      }
    }

    $this->comisionesAnteriores = array_values($this->comisionesAnteriores);
  }

  protected function definirDiasHorariosComisionesAnteriores (){
    $ids = array_column($this->comisionesAnteriores, "id");
    $diasHorarios = $this->mt->diasHorariosComision($ids);
    $this->diasHorarios = array_combine_key($diasHorarios, "comision");
  }

  protected function definirHorariosComisiones(){
    
    $controller = $this->container->getController("horarios_comision_persist_sql");

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
      $this->container->getDb()->multi_query_transaction($persist["sql"]);
    }

    echo "<pre>";
    print_r(["ids"=>$ids, "detail"=>$detail]);
    //return ["ids"=>$ids, "detail"=>$detail];

    //array_push($this->logs, ["sql"=>$controller->getSql(), "detail"=>$controller->getDetail()]);
  }

}
