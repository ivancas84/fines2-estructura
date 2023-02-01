<?php
set_time_limit(0);  
require_once("../config/config.php");
require_once("Container.php");
require_once("controller/Base.php");
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
        $anioCalendario = $_REQUEST["anio"];
        $semestreCalendario = $_REQUEST["semestre"];
        
        if(empty($anioCalendario) || empty($semestreCalendario)) throw new Exception("Parámetros no definidos");
            
        $comisiones = $this->consultarComisiones($anioCalendario,$semestreCalendario);
        /**
         * Consultar comisiones del semestre
        */
    
        $comisiones = $this->quitarComisionesConCursos($comisiones);
        /**
         * quitar comisiones con cursos
        */

        foreach($comisiones as $comision){
            $cargasHorarias = $this->container->controller_("model_tools")->cargasHorariasDePlanificacion($comision["planificacion"]);
            $sql = $this->definirCursos($comision["id"], $cargasHorarias);
            echo "<pre>".$sql;
            $this->container->db()->multi_query_transaction($sql);

        }
    }
    
    protected function consultarComisiones($anioCalendario, $semestreCalendario){
        $c = $this->container->query("comision")
        ->param("calendario-anio",$anioCalendario)
        ->param("calendario-semestre",$semestreCalendario)
        ->size(0)
        ->fields()
        ->all();
        return array_combine_key($c,"id");
    }
    
    protected  function quitarComisionesConCursos($comisiones){
        $ids = array_column($comisiones, "id");

        $c = $this->container->query("curso")
        ->param("comision",$ids)
        ->size(0)
        ->fields()
        ->all();

        $idsConCursos = array_values(array_unique(array_column($c, "comision")));
        

        foreach($idsConCursos as $id) unset($comisiones[$id]);
        return $comisiones;
    }
    

    public function definirCursos($idComision, $cargasHorarias){
        $detail = [];
        $sql = "";
        foreach($cargasHorarias as $ch){
          $curso = [
              "comision" => $idComision,
              "asignatura" => $ch["asignatura"],
              "horas_catedra" => $ch["horas_catedra.sum"],
          ];
          $persist = $this->container->controller("persist_sql","curso")->id($curso);
          array_push($detail,"curso".$persist["id"]);
          $sql .= $persist["sql"];
        }

        return $sql;
    
    }
    
}
 