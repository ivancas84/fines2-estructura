<?php

require_once("class/api/Base.php");
require_once("function/php_input.php");
require_once("function/nombres_parecidos.php");

class InscripcionAlumnoPersistApi extends BaseApi {

  public $persona;
  public $personaExistente;
  public $sql = "";
  public $detail = [];

  public function main() {
    $this->data = php_input();
    /**
     * "persona":"persona"
     * "dom":"domicilio"
     * "detalle_persona/persona":"detalle_persona_"
     */

    
    $this->persona();
    $this->personaExistente();
    $this->addDetallePersonaInscripcion();
    $this->insertDomicilio();

    if(empty($this->personaExistente)) {
      $this->emailUnicoInsertable();
      $this->persistPersonaId();
    }
    else{
      $this->emailUnicoActualizable();

      if($this->isUpdatable()) {
        $this->updatePersona();
      } else {
        $this->modifyPersona();
        $this->persistPersonaUnique();
      }
    }

    $this->persistAlumnoUnique();
    $this->insertDetallePersona_();

    $this->container->getDb()->multi_query_transaction($this->sql);
    $this->emailInscripcion();
    // echo $this->sql;

    return ["detail" => $this->detail];
  }

  public function addDetallePersonaInscripcion(){
    array_push($this->data["detalle_persona/persona"], ["tipo"=>"Inscripción","descripcion"=>"Inscripción"]);
    if(!empty($this->data["persona"]["mensaje"])) array_push($this->data["detalle_persona/persona"], ["tipo"=>"Inscripción","descripcion"=>$this->data["persona"]["mensaje"]]);
  }
  
  public function emailInscripcion(){
    $this->container->getController("email_inscripcion")->main($this->persona->_get("id"));
  }

  public function persona(){
    $this->persona = $this->container->getValue("persona")->_fromArray($this->data["persona"], "set");
  }

  public function personaExistente(){
    $render = $this->container->getEntityRender("persona");
    $p = $this->container->getDb()->unique("persona",$this->data["persona"]);
    if(!empty($p)) $this->personaExistente = $this->container->getValue("persona")->_fromArray($p, "set");
  }

  public function emailUnicoInsertable(){
    $render = $this->container->getEntityRender("persona");
    $render->addCondition([
      ["email","=",$this->data["persona"]["email"]],
    ]);
    if($this->container->getDb()->count("persona",$render)) throw new Exception("ERROR E1: No se puede realizar la inscripción, comunique el error a coordinadores.cens462@gmail.com");
  }

  public function emailUnicoActualizable(){
    $render = $this->container->getEntityRender("persona");
    $render->addCondition([
      ["email","=",$this->data["persona"]["email"]],
      ["id","!=",$this->personaExistente->_get("id")],
    ]);

    if($this->container->getDb()->count("persona",$render)) {
      throw new Exception("ERROR E2: No se puede realizar la inscripción, comunique el error a coordinadores.cens462@gmail.com");
    }
  }

  public function persistPersonaId(){
    $persist = $this->container->getControllerEntity("persist_sql_value", "persona")->id($this->persona);
    $this->sql .= $persist["sql"];
    array_push($this->detail, "persona".$this->persona->_get("id"));
  }

  public function persistPersonaUnique(){
    $persist = $this->container->getControllerEntity("persist_sql_value", "persona")->unique($this->persona);
    $this->sql .= $persist["sql"];
    array_push($this->detail, "persona".$this->persona->_get("id"));
  }

  public function persistAlumnoUnique(){
    $row = [];
    $row["persona"] = $this->persona->_get("id");
    $persist = $this->container->getControllerEntity("persist_sql", "alumno")->unique($row);
    $this->sql .= $persist["sql"];
    array_push($this->detail, "alumno".$row["id"]);
  }

  public function insertDomicilio(){
    $p = $this->container->getControllerEntity("persist_sql", "domicilio")->id($this->data["dom"]);
    $this->sql .= $p["sql"];
    $this->persona->_set("domicilio", $p["id"]);
    array_push($this->detail, "domicilio".$p["id"]);
  }
  

  public function insertDetallePersona_(){
    foreach($this->data["detalle_persona/persona"] as $dp){
      if(empty($dp["descripcion"])) $dp["descripcion"] = "Legajo";
      if(empty($dp["tipo"])) $dp["tipo"] = "Legajo";
      $dp["persona"] = $this->persona->_get("id");
      $persist = $this->container->getControllerEntity("persist_sql", "detalle_persona")->id($dp);
      $this->sql .= $persist["sql"];
      array_push($this->detail, "detalle_persona".$dp["id"]);
    }
  }

  public function isUpdatable(){
    /**
     * Verificar
     *   Nombres parecidos
     *   Coincidencia dni
     *   Coincidencia CUIL
     *   Coincidencia fecha nacimiento
     *   Coincidencia de lugar de nacimiento
     *   Coincidencia de email (si fue previamente validado)
     *   Coincidencia de telefono (si fue previamente validado)
     */
    $response = true;

    if(!$this->personaExistente->checkNombresParecidos($this->persona)) {
      array_push($this->data["detalle_persona/persona"], ["tipo"=>"Inscripción","descripcion"=>"Nombres diferente"]);
      $response = false;
    }

    if($this->personaExistente->_get("numero_documento") != $this->persona->_get("numero_documento")) {
      array_push($this->data["detalle_persona/persona"], ["tipo"=>"Inscripción","descripcion"=>"DNI diferente"]);
      $response = false;
    }

    if(!empty($this->personaExistente->_get("cuil")) && ($this->personaExistente->_get("cuil") != $this->persona->_get("cuil"))) {
      array_push($this->data["detalle_persona/persona"], ["tipo"=>"Inscripción","descripcion"=>"CUIL diferente"]);
      $response = false;
    }

    if(!empty($this->personaExistente->_get("fecha_nacimiento")) && ($this->personaExistente->_get("fecha_nacimiento") != $this->persona->_get("fecha_nacimiento"))) {
      array_push($this->data["detalle_persona/persona"], ["tipo"=>"Inscripción","descripcion"=>"Fecha de nacimiento diferente"]);
      $response = false;
    }

    if(!empty($this->personaExistente->_get("lugar_nacimiento")) && ($this->personaExistente->_get("lugar_nacimiento") != $this->persona->_get("lugar_nacimiento"))) {
      array_push($this->data["detalle_persona/persona"], ["tipo"=>"Inscripción","descripcion"=>"Lugar de nacimiento diferente"]);
      $response = false;
    }

    if($this->personaExistente->_get("email_verificado") && ($this->personaExistente->_get("email") != $this->persona->_get("email"))) {
      array_push($this->data["detalle_persona/persona"], ["tipo"=>"Inscripción","descripcion"=>"Email diferente"]);
      $response = false;
    }

    if($this->personaExistente->_get("telefono_verificado") && ($this->personaExistente->_get("telefono") != $this->persona->_get("telefono"))) {
      array_push($this->data["detalle_persona/persona"], ["tipo"=>"Inscripción","descripcion"=>"Telefono diferente"]);
      $response = false;
    }

    return $response;
  }


  public function updatePersona(){
    $this->persona->_set("id",$this->personaExistente->_get("id"));
    $domicilio = $this->personaExistente->_get("domicilio");
    $this->persona->_set("domicilio", $this->data["dom"]["id"]);
    $this->persistPersonaId();
    if(!empty($domicilio)){
      $this->sql .= $this->container->getEntitySqlo("domicilio")->delete([$domicilio]);
      array_push($this->detail, "domicilio".$domicilio);
    }
  }

  public function modifyPersona(){
    $this->persona->_set("numero_documento","_".$this->persona->_get("numero_documento"));
    $this->persona->_set("cuil","_".$this->persona->_get("cuil"));
  }
}





