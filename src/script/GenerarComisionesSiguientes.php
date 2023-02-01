<?php

require_once("controller/Base.php");
require_once("function/periodo_siguiente.php");
require_once("function/tramo_siguiente.php");

class GenerarComisionesSiguientesScript extends BaseController {
  /**
   * Persistencia de cursos y comisiones para un cierto grupo autorizado
   */


    public function main(){
        $anioCalendario = $_REQUEST["anio"];
        $semestreCalendario = $_REQUEST["semestre"];
    
        $periodoSiguiente = periodo_siguiente($anioCalendario, $semestreCalendario);
        $this->verificarExistenciaComisiones($periodoSiguiente["anio"], $periodoSiguiente["semestre"]);
        $comisiones = $this->comisionesPeriodoActual($anioCalendario, $semestreCalendario);

        echo "<pre>";
        print_r($comisiones);
        $sql = "";

        $controllerValue = $this->container->controller("persist_sql_value","comision");
        $controllerData = $this->container->controller("persist_sql","comision");

        foreach($comisiones as $comision){
            $planificacionSiguiente = $this->planificacionSiguiente($comision["plan-id"],$comision["planificacion-anio"],$comision["planificacion-semestre"]);
            $nuevaComision = $this->container->value("comision");
            $nuevaComision->_fromArray($comision, "set");
            $nuevaComision->_set("id",null);
            $nuevaComision->_set("apertura",false);
            $nuevaComision->_set("calendario","63d8fd2e33a92");
            $nuevaComision->_set("planificacion",$planificacionSiguiente);
            $nuevaComision->_unset("alta");
            $nuevaComision->_set("observaciones",null);
            $nuevaComision->_set("comentario",null);
            $nuevaComision->_set("configuracion",'Histórica');
            
            $persist = $controllerValue->id($nuevaComision);
            $sql .= $persist["sql"];

            $comisionUpdate = [
                "id" => $comision["id"],
                "comision_siguiente"=> $persist["id"]
            ];

            $persist = $controllerData->id($comisionUpdate);
            $sql .= $persist["sql"];

        }

        $this->container->db()->multi_query_transaction($sql);
    }

  protected function verificarExistenciaComisiones($anio, $semestre){
    $count = $this->container->query("comision")
    ->cond([
        ["calendario-anio","=",$anio],
        ["calendario-semestre","=",$semestre],
    ])
    ->size(0)
    ->page(1)
    ->fields(["count"])
    ->columnOne();
    if(intval($count) > 0) throw new Exception("Ya existen comisiones para el periodo indicado");
  }

    protected function comisionesPeriodoActual($anio, $semestre){
        $comisiones = $this->container->query("comision")
        ->cond([
            ["calendario-anio",EQUAL,$anio],
            ["calendario-semestre",EQUAL,$semestre],
            ["autorizada",EQUAL,true],
            ["planificacion-tramo",NONEQUAL,"32"],
        ])
        ->size(0)
        ->fields()
        ->all();
        if(!count($comisiones)) throw new Exception("No existen comisiones actuales");
        return $comisiones;
    }

    protected function planificacionSiguiente($plan, $anio, $semestre){
        $tramo = tramo_siguiente($anio, $semestre);
        
        return $this->container->query("planificacion")->cond([
            ["plan", EQUAL, $plan],
            ["anio", EQUAL, $tramo["anio"]],
            ["semestre", EQUAL, $tramo["semestre"]]
        ])->field("id")->columnOne();

        
    }


  


}




