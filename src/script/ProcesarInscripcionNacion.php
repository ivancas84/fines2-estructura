<?php
set_time_limit(0);  
require_once("controller/Base.php");

class ProcesarInscripcionNacionScript extends BaseController{
 
  protected $comision_ = [];
  protected $sql = "";


  public function main(){
    $this->source = $_REQUEST["source"]; //informacion a procesar


    $import = $this->container->getImport("alumnos_nacion");
    $import->headers = array_map('trim', explode(",",$_REQUEST["headers"])); //encabezados a procesar
    
    $import->source = $_REQUEST["source"]; //informacion a procesar
    $import->main();
    
    // echo "<pre>";
    // print_r($import);
    // $import->summary();

  }    
 
}
