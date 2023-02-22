<?php
set_time_limit(0);  
require_once("../config/config.php");
require_once("Container.php");
require_once("controller/base.php");
require_once("function/array_combine_key2.php");



class TransferirAlumnosActivosScript extends BaseController{

    public function main(){
        $anioCalendario = $_REQUEST["anio"];
        $semestreCalendario = $_REQUEST["semestre"];
        
        if(empty($anioCalendario) || empty($semestreCalendario)) throw new Exception("Parámetros no definidos");
            
        $alumnosComisionActivos = $this->consultarAlumnosActivos($anioCalendario,$semestreCalendario);

        // $alumnosComisionActivos = array_combine_key2($alumnosComisionActivos,["alumno","comision-comision_siguiente"]);
        
        // $alumnosComisionActivos = $this->eliminarAlumnosComisionExistentes($alumnosComisionActivos);

        $sql = "";
        foreach($alumnosComisionActivos as $ac){
            $sql .= $this->definirAlumnoComision($ac);
        }
        echo "<pre>".$sql;
        $this->container->db()->multi_query_transaction($sql);

    }
    
    protected function consultarAlumnosActivos($anioCalendario, $semestreCalendario){
        return $this->container->query("alumno_comision")
        ->param("calendario-anio",$anioCalendario)
        ->param("calendario-semestre",$semestreCalendario)
        ->param("estado","Activo")
        ->param("comision-comision_siguiente",true)
        ->size(0)
        ->fields()
        ->all();
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

    public function definirAlumnoComision($alumnoComision){
        $ac = [
            "comision" => $alumnoComision["comision-comision_siguiente"],
            "alumno" => $alumnoComision["alumno"],
            "estado" => "Activo",
        ];
        $persist = $this->container->controller("persist_sql","alumno_comision")->id($ac);
        return $persist["sql"];
    }
    
    
}
 