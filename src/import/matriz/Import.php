<?php

require_once("import/Import.php");
require_once("model/Db.php");

class MatrizImport extends Import{
  /**
   * Importar Calificaciones
   */
  public $mode = "tab";
  public $id = "matriz";
  public $numeroSede;
  public $division;
  public $comienzoCalificacion = 3;

  public function main(){
    $this->container->entity("curso")->identifier = ["com_sed-numero", "com-division", "com_pla-anio", "com_pla-semestre","asi-codigo"];
    $this->container->entity("calificacion")->identifier = ["per-numero_documento", "cur_com_sed-numero", "cur_com-division", "cur_com_pla-anio", "cur_com_pla-semestre","cur_asi-codigo"];
    parent::main();
    // $this->define();
    //   $this->identify();
    //   $this->query();
    //   $this->process();
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
      $d["com_pla_anio"] = $codigo[1][0];
      $d["com_pla_semestre"] = $codigo[1][1];
      $d["nota_final"] = $value;

      $element = $this->container->getImportElement($this->id);
      $element->numeroSede = $this->numeroSede;
      $element->division = $this->division;
      $element->index = $i.".".($j-$c);
      $element->setEntities($d);
      array_push($this->elements, $element);

    }
  }

  public function identify(){
    $this->ids["persona"] = [];
    $this->ids["calificacion"] = [];
    $this->ids["curso"] = [];
    foreach($this->elements as &$element){
      $dni = $element->entities["persona"]->_get("numero_documento");

      if(Validation::is_empty($dni)){
        $element->process = false;                
        $element->logs->addLog("persona", "error", "El número de documento no se encuentra definido");
        continue;
      }

      $idCurso = $element->entities["curso"]->_get("identifier");
      if(Validation::is_empty($idCurso)){
        $element->process = false;                
        $element->logs->addLog("curso", "error", "El identificador de curso no se encuentra definido");
        continue;
      }

      $idCalificacion = $dni.UNDEFINED.$idCurso;
      $element->entities["calificacion"]->_set("identifier", $idCalificacion);

      if(in_array($idCalificacion, $this->ids["calificacion"])) {
        $element->logs->addLog("calificacion","error","La calificacion esta duplicada");
        $element->process = false;
        continue;        
      }

      array_push($this->ids["calificacion"], $idCalificacion);
      
      if(!in_array($idCurso, $this->ids["curso"])) array_push($this->ids["curso"], $idCurso);

      if(!in_array($dni, $this->ids["persona"])) array_push($this->ids["persona"], $dni);
    }
  }

  public function query(){
    $this->queryEntity("persona","numero_documento");
    $this->queryEntity("curso","identifier");
    $this->queryEntity("calificacion","identifier");
  }

  public function process(){
    foreach($this->elements as &$element) {
      if(!$element->process) continue;

      $dni = $element->entities["persona"]->_get("numero_documento");
      if(!$this->insertPersona($element, $dni)) continue;

      $idCurso = $element->entities["curso"]->_get("identifier");
      if(!$this->existElement($element, "curso", $idCurso)) continue;
       
      $element->entities["calificacion"]->_set("curso",
        $element->entities["curso"]->_get("id")
      );
      $element->entities["calificacion"]->_set("persona",
        $element->entities["persona"]->_get("id")
      );

      $idCalificacion = $element->entities["calificacion"]->_get("identifier");

      $this->processElement($element, "calificacion", $idCalificacion);

      if(Validation::is_empty($element->entities["calificacion"]->_get("crec"))
        && Validation::is_empty($element->entities["calificacion"]->_get("nota_final"))) {
          $element->process = false;
          $element->logs->addLog("calificacion", "info", "Calificacion vacia, no se actualizara ningun valor");                
      } 
    }
  }


  public function insertPersona(&$element, $dni){
    /**
     * Variante del insertElement para verificar los nomrbes de la persona
     */
     
    if(key_exists($dni, $this->dbs["persona"])){
      $personaExistente = $this->container->value("persona");
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