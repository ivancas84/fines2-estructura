<?php

require_once("class/import/Import.php");
require_once("class/model/Db.php");
require_once("class/tools/Validation.php");

class AlumnosNacionImport extends Import{
  /**
   * Importar Alumnos de Comision
   */

  public $id = "alumnos_nacion"; //identificacion de la importacion (para facilitara la instanciacion de la clase Element)
  public $mode = "tab";
  /**
   * @property $dni_: Alumnos existentes en la comisión
   */

  public function main(){
    $this->container->getEntity("alumno")->identifier = ["per-numero_documento"];
    // $this->container->getEntity("alumno_comision")->identifier = ["alu_per-numero_documento", "comision"];

    //parent::main();
    $this->define();
    $this->identify();
    $this->query();
     $this->process();
    // echo "<pre>";
    // print_r($this);
  }

  public function identify(){
    $this->ids["persona"] = [];
    $this->ids["alumno"] = [];
    // $this->ids["alumno_comision"] = [];

    
    foreach($this->elements as &$element){
      if(!$element->process) continue;
      if(!($dni = $element->getIdentifier("persona", "numero_documento"))) continue;
      if(!($idAlumno = $element->getIdentifier("alumno"))) continue;
      // if(!($idAlumnoComision = $element->getIdentifier("alumno_comision"))) continue;

      if(!$this->idEntityFieldCheck("alumno", $idAlumno, $element)) continue;
      if(!$this->idEntityFieldCheck("persona", $dni, $element)) continue;
      // if(!$this->idEntityFieldCheck("alumno_comision", $idAlumnoComision, $element)) continue;
    }
  }

  public function query(){
    $this->queryEntityField("persona","numero_documento");
    $this->queryEntityField("alumno");
    $this->queryAlumnoComision();
  }


  protected function queryAlumnoComision(){
    /**
     * Consulta a la base de datos de la entidad $entityName.
     * 
     * Utilizando el campo $field (supuestamente unico) y el valor almacenado 
     * de field desde el atributo "ids".
     * Todos los resultados los carga en el atributo "dbs" que indica los va-
     * lores que fueron extraidos de la base de datos.
     */
    $this->dbs["alumno_comision"] = [];

    $render = new Render();
    $render->setSize(false);
    $render->setCondition([
      ["alu_per-numero_documento","=",$this->ids["persona"]],
      [
        [
          ["com_cal-anio","=","2022"],["com_cal-semestre","=","1"]
        ],
        [
         ["com_cal-anio","=","2021","OR"], ["com_cal-semestre","=","2"]
        ]
      ]
    ]);
    // $render->addCondition(["com_cal-semestre","=","1"]);
    $rows = $this->container->getDb()->all("alumno_comision", $render);

    //si se devuelven varias instancias del mismo identificador (no deberia pasar) solo se considerara una
    $this->dbs["alumno_comision"] = array_combine_key(
      $rows,
      "alu_per_numero_documento"
    );
  }

  public function process(){

    $i = 2;    
    foreach($this->elements as &$element) {
      $i++;
      if(!$element->process) {
        echo "$i sin procesar<br>";
        continue;
      } 

      $dni = $element->entities["persona"]->_get("numero_documento");
      if(array_key_exists($dni, $this->dbs["alumno_comision"])) echo $i . " ESTA EN COMISION " . $this->dbs[$dni]["com_id"]."<br>"; 
      elseif($element->institucion == "CENTRO EDUCATIVO DE NIVEL SECUNDARIO Nº462") echo $i ." " . $dni. " no esta en ninguna comision"."<br>"; 
      //else echo $i . " pertenece a otro cens";
    }
  }

  
}