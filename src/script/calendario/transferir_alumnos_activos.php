<?php
set_time_limit(0);  
require_once("../config/config.php");
require_once("Container.php");
require_once("controller/base.php");
require_once("function/array_combine_key2.php");
require_once("function/periodo_siguiente.php");




class CalendarioTransferirAlumnosActivosScript extends BaseController{


    public function main(){
        $anio_calendario = $_REQUEST["anio"];
        $semestre_calendario = $_REQUEST["semestre"];
        
        if(empty($anio_calendario) || empty($semestre_calendario)) throw new Exception("Parámetros no definidos");
            
        $calendario_alumnos = $this->container->controller("alumnos","calendario");

        $alumnos_comision_activos = $calendario_alumnos->alumnos_comision_activos_con_siguiente($anio_calendario, $semestre_calendario);

        $periodo_siguiente = periodo_siguiente($anio_calendario, $semestre_calendario);

        $alumnos_comision_existentes = $calendario_alumnos->alumnos_comision($periodo_siguiente["anio"], $periodo_siguiente["semestre"]);

        $alumnos_comision_existentes = array_combine_key2($alumnos_comision_existentes, ["comision","alumno"]);

        $sql = "";

        echo "<pre>";
        // print_r($alumnos_comision_activos);

        foreach($alumnos_comision_activos as $ac){
            if($ac["comision-comision_siguiente"] == "63d904a8d2de2") print_r($ac);
            if (array_key_exists($ac["comision-comision_siguiente"].UNDEFINED.$ac["alumno"], $alumnos_comision_existentes)) {
                
                if($ac["comision-comision_siguiente"] == "63d904a8d2de2") {
                    echo "existencia";
                    print_r($alumnos_comision_existentes[$ac["comision-comision_siguiente"].UNDEFINED.$ac["alumno"]]);
                }
                continue;
            }
            $ac = [
                "comision" => $ac["comision-comision_siguiente"],
                "alumno" => $ac["alumno"],
                "estado" => "Activo",
            ];
            $persist = $this->container->controller("persist_sql","alumno_comision")->id($ac);
            $sql .= $persist["sql"];
        }


       
        echo "<pre>".$sql;
        // // $this->container->db()->multi_query_transaction($sql);

    }
    
    
    public function eliminarAlumnosComisionExistentes($alumnoComision_){
        $query = $this->container->query("alumno_comision");
        foreach($alumnoComision_ as $ac){
            $query->cond([
                ["alumno",EQUAL,$ac["alumno"], "OR"],
                ["comision",EQUAL,$ac["comision-comision_siguiente"]],
                ["estado",EQUAL,"Activo"]
            ]);
        }
        $idComisionSiguienteEliminar = array_column($alumnoComision_,"comision");
        $alumnoComisionAux_ = $query->param("comision",$idComisionSiguiente)
        ->size(0)
        ->fields()
        ->all();

        foreach($alumnoComisionAux_ as $ac) unset($alumnoComision_[$ac["alumno"].UNDEFINED.$ac["comision"]]);
        
        return $alumnoComision_;

    }

    protected function definir_alumno_comision($alumnoComision){
        
    }
    
    
}
 