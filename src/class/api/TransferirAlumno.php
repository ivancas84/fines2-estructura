<?php

require_once("class/api/Base.php");
require_once("function/php_input.php");
require_once("function/array_combine_key.php");

class TransferirAlumnoApi extends BaseApi {

  public $data;
  public $sql = "";
  public $detail = [];
  public $alumnoTransferir = [];
  public $alumnoExistente = [];

  public function main() {
    $this->container->getAuth()->authorize($this->entityName, $this->permission);
    $this->data = php_input();
    /**
     * id: persona a transferir
     * persona: dni de la persona a las cuales se transferiran los datos
     */

    $this->alumnoTransferir();
    $this->alumnoExistente();
    $this->transferirEntidadAlumno();
    $this->transferirEntidadAlumnoComision();
    $this->transferirEntidadCalificacion();
    $this->transferirEntidadDisposicionPendiente_();
    $this->transferirEntidadDetallePersona();

    if($this->alumnoTransferir) {
      $this->sql .= $this->container->getSqlo("alumno")->delete([$this->alumnoTransferir["id"]]);
      array_push($this->detail, "alumno".$this->alumnoTransferir["id"]);
    }

    $this->sql .= $this->container->getSqlo("persona")->delete([$this->data["id"]]);
    array_push($this->detail, "persona".$this->data["id"]);

    $this->actualizarPersona();

    //echo "<pre>".$this->sql;
    $this->container->getDb()->multi_query_transaction($this->sql);
    return(["id"=>null,"detail"=>$this->detail]);
  }

  public function actualizarPersona(){
    $persona = $this->container->getDb()->get("persona",$this->data["persona"]);
    $p = [
      "id" => $persona["id"],
      "numero_documento" => trim($persona["numero_documento"], "_"),
      "cuil" => trim($persona["cuil"], "_")
    ];
    $persist = $this->container->getControllerEntity("persist_sql", "persona")->id($p);
    $this->sql .= $persist["sql"];      
    array_push($this->detail, "persona".$p["id"]);
  }

  public function transferirEntidadAlumnoComision(){
    if(!$this->alumnoTransferir) return;

    $render = $this->container->getRender("alumno_comision");
    $render->setCondition([
      ["alumno","=",$this->alumnoTransferir["id"]]
    ]);
    $transferir = array_combine_key(
      $this->container->getDb()->all("alumno_comision",$render),
      "comision"
    );

    $existentes = [];
    if($this->alumnoExistente){
      $render = $this->container->getRender("alumno_comision");
      $render->setCondition([
        ["alumno","=",$this->alumnoExistente["id"]]
      ]);
      $existentes = array_combine_key( 
        $this->container->getDb()->all("alumno_comision",$render),
        "comision"
      );
    }

    foreach($transferir as $comisionAt => $alumnoComision){
      $at = $this->container->getRel("alumno_comision")->value($alumnoComision)["alumno_comision"];

      if(in_array($comisionAt, $existentes)){
        $ae = $this->container->getRel("alumno_comision")->value($existentes[$comisionAt])["alumno_comision"];
        
        $this->transferirElementoExistente($at, $ae, "activo");
        $this->transferirElementoAdicional($at, $ae, "observaciones");
        $this->actualizarElemento($ae, "alumno_comision");
        $this->eliminarElemento($at, "alumno_comision");
      } else {
        $this->insertarElemento($at, "alumno_comision", "alumno", $this->alumnoExistente["id"]);
      }
    }
  }

  public function insertarElemento($elemento, $entityName, $fkName, $id){
    $elemento->_fastSet("alumno",$this->alumnoExistente["id"]);
    $elemento->_call("reset")->_call("check");
    if($elemento->logs->isError()) throw new Exception($elemento->logs->toString());
    $this->sql .= $this->container->getSqlo($entityName)->update($elemento->_toArray("sql"));      
    array_push($this->detail, $entityName.$elemento->_get("id"));
  }

  public function actualizarElemento($elemento, $entityName) {
    $elemento->_call("reset")->_call("check");
    if($elemento->logs->isError()) throw new Exception($elemento->logs->toString());
    $this->sql .= $this->container->getSqlo($entityName)->update($elemento->_toArray("sql"));    
    array_push($this->detail, $entityName.$elemento->_get("id"));
  }

  public function eliminarElemento($elemento, $entityName){
    $this->sql .= $this->container->getSqlo($entityName)->delete([$elemento->_get("id")]);
    array_push($this->detail, $entityName.$elemento->_get("id"));  
  }
  
  public function transferirElementoExistente($transferir, &$existente, $key){
    if(!$existente->_get($key) 
      && $transferir->_get($key)
    ) $existente->_fastSet($key, $transferir->_get($key));
  }

  public function transferirElementoAdicional($transferir, &$existente, $key){
    if($transferir->_get($key)) {
      if($existente->_get($key)) $existente->_fastSet($key, $existente->_get($key) . " / " . $transferir->_get($key));
      else $existente->_fastSet($key, $transferir->_get($key));
    }
  }

  
  public function alumnoTransferir(){
    $render = $this->container->getRender("alumno");
    $render->setCondition([
      ["persona","=",$this->data["id"]]
    ]);
    $this->alumnoTransferir = $this->container->getDb()->oneOrNull("alumno",$render);
  }

  public function alumnoExistente(){
    $render = $this->container->getRender("alumno");
    $render->setCondition([
      ["persona","=",$this->data["persona"]]
    ]);
    $this->alumnoExistente = $this->container->getDb()->oneOrNull("alumno",$render);
  }

  
  public function transferirEntidadAlumno(){

    if(empty($this->alumnoTransferir)) return; //si no tiene alumno el que se transfiere

    $at = $this->container->getValue("alumno")->_fromArray($this->alumnoTransferir,"set");

    if(!empty($this->alumnoExistente)){
      $ae = $this->container->getValue("alumno")->_fromArray($this->alumnoExistente,"set");
      $this->transferirElementoExistente($at, $ae, "anio_ingreso");
      $this->transferirElementoExistente($at, $ae, "semestre_ingreso");
      $this->transferirElementoExistente($at, $ae, "estado_inscripcion");
      $this->transferirElementoExistente($at, $ae, "resolucion_inscripcion");
      $this->transferirElementoExistente($at, $ae, "anio_inscripcion");
      $this->transferirElementoExistente($at, $ae, "semestre_inscripcion");
      $this->transferirElementoExistente($at, $ae, "adeuda_legajo");
      $this->transferirElementoExistente($at, $ae, "adeuda_deudores");
      $this->transferirElementoExistente($at, $ae, "fecha_titulacion");
      $this->transferirElementoExistente($at, $ae, "plan");
      $this->transferirElementoAdicional($at, $ae, "observaciones");
      $this->actualizarElemento($ae, "alumno");
    } else {
      $this->insertarElemento($at, "alumno", "persona", $this->data["persona"]);
    }
  }


  public function transferirEntidadCalificacion(){
    $render = $this->container->getRender("calificacion");
    $render->setCondition([
      ["alumno","=",$this->alumnoTransferir["id"]]
    ]);
    $transferir = array_combine_key(
      $this->container->getDb()->all("calificacion",$render),
      "disposicion"
    );

    $render = $this->container->getRender("calificacion");
    $render->setCondition([
      ["alumno","=",$this->alumnoExistente["id"]]
    ]);
    $existentes = array_combine_key( 
      $this->container->getDb()->all("calificacion",$render),
      "disposicion"
    );

    foreach($transferir as $disposicion => $calificacion){
      $tr = $this->container->getRel("calificacion")->value($calificacion)["calificacion"];

      if(in_array($disposicion, $existentes)){
        $ex = $this->container->getRel("calificacion")->value($existentes[$curso])["calificacion"];
        
        $compare = $this->compareCalificacion($tr,$ex);
        if(!empty($compare)) throw new Exception("No se puede transferir, comparacion erronea: ". $compare);
        
        $this->transferirElementoExistente($tr, $ex, "nota1");
        $this->transferirElementoExistente($tr, $ex, "nota2");
        $this->transferirElementoExistente($tr, $ex, "nota3");
        $this->transferirElementoExistente($tr, $ex, "nota_final");
        $this->transferirElementoExistente($tr, $ex, "crec");
        $this->transferirElementoExistente($tr, $ex, "porcentaje_asistencia");
        $this->transferirElementoAdicional($tr, $ex, "observaciones");

        $this->actualizarElemento($ex, "calificacion");
        $this->eliminarElemento($tr, "calificacion");

      } else {
        $this->insertarElemento($tr, "calificacion", "alumno", $this->alumnoExistente["id"]);
      }
    }

  }


  public function transferirEntidadDisposicionPendiente_(){
    $render = $this->container->getControllerEntity("render_build", "disposicion_pendiente")->main();
    $render->setCondition([
      ["alumno","=",$this->alumnoTransferir["id"]]
    ]);
    $transferir = array_combine_key(
      $this->container->getDb()->all("disposicion_pendiente",$render),
      "disposicion"
    );

    $render = $this->container->getControllerEntity("render_build", "disposicion_pendiente")->main();
    $render->setCondition([
      ["alumno","=",$this->alumnoExistente["id"]]
    ]);
    $existentes = array_combine_key( 
      $this->container->getDb()->all("disposicion_pendiente",$render),
      "disposicion"
    );

    foreach($transferir as $disposicion => $disposicionPendiente){
      $tr = $this->container->getRel("disposicion_pendiente")->value($disposicionPendiente)["disposicion_pendiente"];

      if(in_array($disposicion, $existentes)){
        $ex = $this->container->getRel("disposicion_pendiente")->value($existentes[$curso])["calificacion"];
        
        $this->transferirElementoExistente($tr, $ex, "modo");
        $this->actualizarElemento($ex, "disposicion_pendiente");
        $this->eliminarElemento($tr, "disposicion_pendiente");
      } else {
        $this->insertarElemento($tr, "disposicion_pendiente", "alumno", $this->alumnoExistente["id"]);
      }
    }

  }



  public function transferirEntidadDetallePersona(){
    $persist = $this->container->getController("model_resources")->transferirEntidad("detalle_persona","persona", $this->data["id"],$this->data["persona"]);
    $this->sql .= $persist["sql"];
    $this->detail = array_merge($this->detail,$persist["detail"]);
  }


  public function compareCalificacion($tr, $ex){
    $a = $tr->_toArray("sql");
    $b = $ex->_toArray("sql");
    $compare = [];
    foreach($a as $ka => $va) {
      if( ($ka =="id") || ($ka =="alumno") || ($ka =="observaciones") ) continue;
      if(((is_null($va) || $va == "null")) || !key_exists($ka, $b) || $b[$ka]) continue;
      if($b[$ka] !== $va) array_push($compare, $ka);
    }
    return (empty($compare)) ? true : implode(", ", $compare);
  }

}
