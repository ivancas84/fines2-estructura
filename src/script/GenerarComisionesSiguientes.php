<?php
set_time_limit(0);  
require_once("controller/Base.php");

class GenerarComisionesSiguientesScript extends BaseController{
 

  public function main(){
    $container = new Container;
    $import = $container->getImport("comisiones_siguientes");
    $import->idCalendario = '62c2eea47c189';
    $import->anio ="2022";
    $import->semestre = "1";
    $import->modalidad =  '7';
    $import->centroEducativo = '6047d36d50316';
    $import->initialize();
    $import->defineSource();
    $import->main();
    $import->summary();
    // echo "<pre>";
    // print_r($import);
  }    
 
}
