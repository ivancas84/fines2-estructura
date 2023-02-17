<?php

require_once("api/Base.php");
require_once("function/php_input.php");

require_once("function/array_group_value.php");
require_once("function/array_unset_keys.php");
require_once("function/array_combine_key.php");

class ComisionActualizarDisposicionesPendientesAlumnosApi extends BaseApi {

  public $idComision;
  public $comision;

  public $idAlumno_ = [];
  public $alumno__calificacionAprobada_ = [];
  public $disposicion_ = [];
  public $calculo = [];

  public function main() {
    $this->container->getAuth()->authorize("alumno", "r");
    $this->idComision = file_get_contents("php://input");
    $this->comision = $this->container->db()->get("comision", $this->idComision);

    $this->idAlumno_();
    $this->alumno__calificacionAprobada_();
    $this->disposicion_();
    $this->calcular();
    return $this->actualizar();

  }


  public function idAlumno_(){
    $render = $this->container->getEntityRender("alumno_comision");
    $render->setCondition([
      ["comision","=",$this->comision["id"]],
    ]);
    $render->setFields(["alumno"]);
    $render->setSize(0);
    $this->idAlumno_ = array_column(
      $this->container->db()->select("alumno_comision",$render),
      "alumno"
    );
  }



  public function alumno__calificacionAprobada_(){
    /**
     * Array asociativo id_alumno => array de calificaciones aprobadas
     */
    if(empty($this->idAlumno_)) return [];
    $render = $this->container->getEntityRender("calificacion");
    $render->setSize(0);
    $render->setCondition([
      ["alumno","=",$this->idAlumno_],
      ["plan-id","=",$this->comision["plan_id"]],
      [
        ["nota_final",">=","7"],
        ["crec",">=","4","OR"]
      ]
    ]);
    //$render->setFields(["cantidad"=>"id.count"]);
    //$render->setGroup(["alumno"=>"alumno"]);
    
    $this->alumno__calificacionAprobada_ = array_group_value(
      $this->container->db()->all("calificacion",$render),
      "alumno"
    );
  }


  public function disposicion_(){
    $render = $this->container->getEntityRender("disposicion");
    $render->setSize(0);
    $render->setCondition([
      ["plan-id","=",$this->comision["plan_id"]],
    ]);
    $render->setOrder(["planificacion-anio"=>"asc","planificacion-semestre"=>"asc", "asignatura-nombre"=>"asc"]);
    
    $this->disposicion_ = array_combine_key(
      $this->container->db()->all("disposicion",$render),
      "id"
    );
  }


  public function calcular(){
    foreach($this->alumno__calificacionAprobada_ as $alumno => $calificacionAprobada_){
      $r = [];
      $r["alumno"] = $alumno;
      $r["cantidad_aprobada"] = count($calificacionAprobada_);
      $idDisposicionAprobada_ = array_column($calificacionAprobada_, "disposicion");
      $disposicionDesaprobada_ = array_unset_keys($this->disposicion_, $idDisposicionAprobada_);
      
      $anioIngreso = (empty($calificacionAprobada_[0]["alu_anio_ingreso"])) ? 1 : intval($calificacionAprobada_[0]["alu_anio_ingreso"]);  
      $disposicionDesaprobadaResultante_ = [];
      foreach($disposicionDesaprobada_ as $dd){
        if(intval($dd["pla_anio"]) < $anioIngreso) continue;
        array_push($disposicionDesaprobadaResultante_, $dd);
      }
      $r["cantidad_no_aprobada"] = count($disposicionDesaprobadaResultante_);
      $r["_disposicion_no_aprobada"] = $disposicionDesaprobadaResultante_;
      array_push($this->calculo, $r);
    }
  }


  public function actualizar(){
    if(empty($this->calculo)) return ["ids"=>[],"detail"=>[]];
    $sql = "";
    $detail = [];
    foreach($this->calculo as $row){
      $render = $this->container->getEntityRender("disposicion_pendiente")->setCondition(["alumno","=",$row["alumno"]]);

      $idDisposicionEliminar_ = array_column(
        $this->container->db()->all("disposicion_pendiente",$render),
        "id"
      );

      foreach($idDisposicionEliminar_ as $id) array_push($detail, "disposicion_pendiente".$id);
      if(!empty($idDisposicionEliminar_)) $sql .= $this->container->getEntitySqlo("disposicion_pendiente")->delete($idDisposicionEliminar_);
      foreach($row["_disposicion_no_aprobada"] as $r){
        $a = [
          "alumno" => $row["alumno"],
          "disposicion" => $r["id"]
        ];

        $persist = $this->container->controller("persist_sql", "disposicion_pendiente")->id($a);
        $sql .= $persist["sql"];
        array_push($detail, "disposicion_pendiente".$persist["id"]);
      }
    }

    $this->container->db()->multi_query_transaction($sql);
    return ["detail"=>$detail];
  }

  
  
}
