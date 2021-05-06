<?php

require_once("class/import/Import.php");
require_once("class/model/Db.php");

class ControlDuplicadosImport extends Import{
  /**
   * Importar Calificaciones
   */
  public $mode = "tab";
  public $id = "control_duplicados";
  public $headers = ["numero_documento"];

  public function query(){}
  public function process(){}
  
  public function identify(){
    $this->ids["persona"] = [];

    foreach($this->elements as &$element){
      $dni = $element->entities["persona"]->_get("numero_documento");

      if(!$element->process) continue;

      if(in_array($dni, $this->ids["persona"])) {
        $element->process = false;                
        $element->logs->addLog("persona", "error", "El número de documento esta duplicado");
      } 
      
      array_push($this->ids["persona"], $dni);
    }
  }

  public function summary() {
        $informe = "<h3>Resultado " . $this->id . "</h3>";
        $informe .= "<p>Cantidad de filas procesadas: " . count($this->elements) . "</p>
";      
    
        echo "<pre>";
        foreach($this->elements as $element) {
          if(empty($element->logs->getLogs())) continue;

          
          $informe .= "
    <div class=\"card\">
    <ul class=\"list-group list-group-flush\">
        <li class=\"list-group-item active\">FILA " . ($element->index) . "</li>
";        
           
          $informe .= "       <li class=\"list-group-item list-group-item-danger font-weight-bold\">" . $element->id() . "</li>
";

          foreach($element->logs->getLogs() as $key => $logs) {
            foreach($logs as $log){
              $class = ($log["status"] == "error") ? "red" : "blue" ;
              $informe .= "        <li style=\"color:{$class}\">" . $key . " " .$log["data"]."</li>
";
            }
          }
          $informe .= "    </ul>
    </div>
    <br><br>";                          
        }
         
        if(!empty($this->pathSummary)) file_put_contents($this->pathSummary . ".html", $informe);
    
        echo $informe;
    }

}