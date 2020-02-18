<?php


require_once("class/controller/Persist.php");
require_once("class/model/Ma.php");
require_once("class/model/Values.php");
require_once("class/controller/persist/ComisionCursos.php");



class HorariosComisionPersist extends Persist {
  /**
   * Definir horarios de una comision basandose en la anterior
   */
  protected $entityName = "horarios_comision";

  public function main($id){
    if(empty($id)) throw new Exception("Dato no definido: id comision");
   

  }


  
    


}




