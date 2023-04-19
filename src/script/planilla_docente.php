<?php

set_time_limit(0);  
require_once("controller/base.php");
require_once("function/array_group_value.php");
require_once("function/array_combine_key.php");
require_once("function/array_combine_keys.php");
require_once("function/acronym.php");


class PlanillaDocenteScript extends BaseController{
 /**
   * Formulario para cargar calificaciones
   * ./script/calificacion_form
   */

  public function main(){

      $rows = $this->container->query("asignacion_planilla_docente")
          ->size(0)
          ->cond([
              ["calendario-anio","=","2023"],
              ["calendario-semestre","=","1"],
              ["reclamo","=",false],
              ["toma-estado","=",["Aprobada","Renuncia"]],
              //["comision-modalidad","=","7"],
              //["planilla_docente","=",$_GET["planilla_docente"]]
          ])->fields()->all();

      $id_tomas = array_column($rows, "toma");

      $query = $this->container->query("toma")->size(0)->fields()->cond([
          ["calendario-anio","=","2023"],
          ["calendario-semestre","=","1"],
          //["comision-modalidad","=","7"],
          ["estado","=",["Aprobada","Renuncia"]],
          ["estado_contralor","=","Pasar"],
      ]);

      if(!empty($id_tomas)) $query->cond(["id","!=",$id_tomas]);

      $rows = $query->order(["docente-numero_documento"=>"ASC"])->all();

      // foreach($rows as $row) {
      //     echo "<br>INSERT INTO asignacion_planilla_docente(id, toma, planilla_docente, reclamo) VALUES ('".uniqid()."', '".$row["id"]."','202210061315', false);";
      // }

      // die();

      require_once("script/planilla_docente.html");
  }

  
}