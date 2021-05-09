<?php

require_once("class/import/Import.php");
require_once("class/model/Db.php");

class MatrizPlanificacionImport extends Import{
  /**
   * Importar matrices
   */
  public $mode = "tab";
  public $idPlan;
  public $comienzoCalificacion = 3;

  public function main(){
    $this->container->getEntity("planificacion")->identifier = ["plan","anio", "semestre"];
    $this->container->getEntity("calificacion")->identifier = ["per-numero_documento", "pla-plan", "pla-anio", "pla-semestre", "asi-codigo"];
    //parent::main();
     $this->define();
       $this->identify();
       $this->query();
       $this->process();
    //$this->persist();
  }

  
  public function element($i, $data){ //@override
    /**
     * Debido a que los parametros poseen mas de un juego de entidades, se sobrescribe element para definir todas las entidades
     */
    $d = [];

    $d["per_nombres"] = $data["per_nombres"];
    $d["per_apellidos"] = $data["per_apellidos"];
    $d["per_numero_documento"] = $data["per_numero_documento"];
    $j = -1;  
    $c = $this->comienzoCalificacion; 
    foreach($data as $key => $value) {


      $j++;
      if($j < $c) continue;

      $codigo = explode("/", $key);
      $d["asi_codigo"] = $codigo[0];
      $d["pla_anio"] = $codigo[1][0];
      $d["pla_semestre"] = $codigo[1][1];
      $d["nota_final"] = $value;

      $element = $this->container->getImportElement($this->id);
      $element->idPlan = $this->idPlan;
      $element->index = $i.".".($j-$c);
      $element->setEntities($d);
      array_push($this->elements, $element);

    }
  }

  public function identify(){
    $this->ids["persona"] = [];
    $this->ids["calificacion"] = [];
    $this->ids["asignatura"] = [];
    $this->ids["planificacion"] = [];


    foreach($this->elements as &$element){
      if(!($dni = $element->getIdentifier("persona", "numero_documento"))) continue;
      if(!($idPlanificacion = $element->getIdentifier("planificacion"))) continue;
      if(!($codigoAsignatura = $element->getIdentifier("asignatura", "codigo"))) continue;
      
      $idCalificacion = $dni.UNDEFINED.$idPlanificacion.UNDEFINED.$codigoAsignatura;
      $element->entities["calificacion"]->_set("identifier", $idCalificacion);

      if(!$this->idEntityFieldCheck("calificacion", $idCalificacion, $element)) continue;
      $this->idEntityField("planificacion", $idPlanificacion);
      $this->idEntityField("persona", $dni);
      $this->idEntityField("asignatura", $codigoAsignatura);
    }
  }

  public function query(){
    $this->queryEntityField("persona","numero_documento");
    $this->queryEntityField("asignatura","codigo");
    $this->queryEntityField("planificacion","identifier");
    $this->queryEntityField("calificacion","identifier");
  }

  public function process(){
    foreach($this->elements as &$element) {
      if(!$element->process) continue;

      if(!$this->insertPersona($element)) continue;
      if(!$this->existElement($element, "asignatura", "codigo")) continue;
      if(!$this->existElement($element, "planificacion")) continue;
      if(!$this->processCalificacion($element)) continue;

    }
  }
  

  public function processCalificacion(&$element){
    $element->entities["calificacion"]->_set("asignatura",
        $element->entities["asignatura"]->_get("id")
      );
      $element->entities["calificacion"]->_set("planificacion",
        $element->entities["planificacion"]->_get("id")
      );
      $element->entities["calificacion"]->_set("persona",
        $element->entities["persona"]->_get("id")
      );

      $this->processElement($element, "calificacion");

      if(Validation::is_empty($element->entities["calificacion"]->_get("crec"))
        && Validation::is_empty($element->entities["calificacion"]->_get("nota_final"))) {
          $element->process = false;
          $element->logs->addLog("calificacion", "info", "Calificacion vacia, no se actualizara ningun valor");
          return false;                
      }
      return true;
  }


  public function insertPersona(&$element){
    $dni = $element->entities["persona"]->_get("numero_documento");
 
    /**
     * Variante del insertElement para verificar los nomrbes de la persona
     */
     
    if(key_exists($dni, $this->dbs["persona"])){
      $personaExistente = $this->container->getValue("persona");
      $personaExistente->_fromArray($this->dbs["persona"][$dni], "set");
      if(!$element->entities["persona"]->checkNombresParecidos($personaExistente)){
        $element->logs->addLog("persona", "error", "En la base existe una persona cuyos datos no coinciden");
        $element->process = false;
        return false;
      }

      $element->entities["persona"]->_set("id",$personaExistente->_get("id"));
      $element->logs->addLog("persona", "info", "Registro existente, no será actualizado");
    } else {
      $element->insert("persona");
      $this->dbs["persona"] = $element->entities["persona"]->_toArray("get");
    }

    return true;
  }

}