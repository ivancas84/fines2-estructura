<?php
set_time_limit(0);  
require_once("../config/config.php");
require_once("class/Container.php");
require_once("class/controller/Base.php");
require_once("function/array_combine_key.php");



class GenerarCursosComisionesScript extends BaseController{
  /**
   * Consultar las comisiones del grupo indicado.
   * Quitar aquellas comisiones que ya poseen cursos.
   * Definir los cursos para las comisiones sin cursos.
   * 
   * ./script/generar_comisiones_cursos
   */
   protected $comisionesAnteriores;
   protected $diasHorarios;
 
   public function main(){
     $grupo = ["cal-anio"=>'2022',"cal-semestre"=>2,"modalidad"=>"1","autorizada"=>true];
 
     if(empty($grupo["cal-anio"])) throw new Exception("Dato no definido: fecha anio");
     if(empty($grupo["cal-semestre"])) throw new Exception("Dato no definido: fecha semestre");
     if(empty($grupo["modalidad"])) throw new Exception("Dato no definido: modalidad");
     //if(empty($grupo["sed-centro_educativo"])) throw new Exception("Dato no definido: centro educativo (sed_centro_educativo)");
        
     $this->consultarComisiones($grupo);
     /**
      * Consultar comisiones del grupo, que tengan el campo siguiente definido
      */
 
     $this->quitarComisionesConCursos();
     /**
      * quitar comisiones con cursos
      */

     $this->definirCursos();
     /**
      * definir cursos para las comisiones del grupo
      */
   }
   
   protected function consultarComisiones($grupo){

     $render = $this->container->getEntityRender("comision");
     $render->setParams($grupo);
     $render->setSize(0);  
     $this->comisiones = array_combine_key($this->container->getDb()->all("comision",$render),"id");
   }
 
   protected  function quitarComisionesConCursos(){
     $ids = array_column($this->comisiones, "id");
     $render = $this->container->getEntityRender("curso");
     $render->addCondition(["comision","=",$ids]);
     $render->setSize(0);
     $cursos = $this->container->getDb()->all("curso",$render);
     $idsConCursos = array_values(array_unique(array_column($cursos, "comision")));
     
     foreach($idsConCursos as $id) unset($this->comisiones[$id]);
   }
 
    protected function definirCursos(){
      $controller = $this->container->controller("persist_sql", "cursos_comision");
      $ids = [];
      $detail = [];
      $sql = "";
      foreach($this->comisiones as $id => $comision){
        $persist = $controller->main($id);
        array_push($ids, $persist["id"]);
        $detail = array_merge($detail,$persist["detail"]);
        $sql .= $persist["sql"];
      }
  
      $this->container->getDb()->multi_query_transaction($sql);
      echo "<pre>";
      echo $sql;
   }
 
}
 