<?php

require_once("class/model/Sqlo.php");
require_once("class/db/SqlFormat.php");

//Implementacion principal de Sqlo para una entidad especifica
class DocumentacionRecibidaSqloMain extends EntitySqlo {

  //Constructor
  //Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
  public function __construct(){
    $this->entity = new DocumentacionRecibidaEntity;
    $this->sql = new DocumentacionRecibidaSql($this->entity);
  }

  //@override
  protected function _insert(array $row){
    $sql = "
INSERT INTO " . $this->entity->sn_() . " (";
    $sql .= "id, " ;
    $sql .= "fecha_recepcion, " ;
    $sql .= "calificaciones, " ;
    $sql .= "asistencia, " ;
    $sql .= "temas_tratados, " ;
    $sql .= "calificaciones_digital, " ;
    $sql .= "toma, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma    

    $sql .= ") 
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['fecha_recepcion'] . ", " ;
    $sql .= $row['calificaciones'] . ", " ;
    $sql .= $row['asistencia'] . ", " ;
    $sql .= $row['temas_tratados'] . ", " ;
    $sql .= $row['calificaciones_digital'] . ", " ;
    $sql .= $row['toma'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma    

    $sql .= ");
";
  
    return $sql;
  }

  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : $this->nextPk();
    if(!isset($data['fecha_recepcion']))  throw new Exception('fecha/hora obligatoria sin valor: fecha_recepcion');
    if(!isset($data['calificaciones']) || ($data['calificaciones'] == '')) $data['calificaciones'] = "false";
    if(!isset($data['asistencia']) || ($data['asistencia'] == '')) $data['asistencia'] = "false";
    if(!isset($data['temas_tratados']) || ($data['temas_tratados'] == '')) $data['temas_tratados'] = "false";
    if(!isset($data['calificaciones_digital']) || ($data['calificaciones_digital'] == '')) $data['calificaciones_digital'] = "false";
    if(!isset($data['toma']) || ($data['toma'] == '')) throw new Exception('dato obligatorio sin valor: toma');

    return $data;
  }

  //@override
  protected function _update(array $row){
    $sql = "
UPDATE " . $this->entity->sn_() . " SET 
"; 
    if (isset($row['fecha_recepcion'] )) $sql .= "fecha_recepcion = " . $row['fecha_recepcion'] . " ," ;
    if (isset($row['calificaciones'] )) $sql .= "calificaciones = " . $row['calificaciones'] . " ," ;
    if (isset($row['asistencia'] )) $sql .= "asistencia = " . $row['asistencia'] . " ," ;
    if (isset($row['temas_tratados'] )) $sql .= "temas_tratados = " . $row['temas_tratados'] . " ," ;
    if (isset($row['calificaciones_digital'] )) $sql .= "calificaciones_digital = " . $row['calificaciones_digital'] . " ," ;
    if (isset($row['toma'] )) $sql .= "toma = " . $row['toma'] . " ," ;
    //eliminar ultima coma    
    $sql = substr($sql, 0, -2);

        
    $sql .= "
WHERE id = " . $row['id'] . ";
"; 
  
    return $sql;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('fecha_recepcion', $data)) { if(empty($data['fecha_recepcion']))  throw new Exception('fecha/hora obligatoria sin valor: fecha_recepcion'); }
    if(array_key_exists('calificaciones', $data)) { if(!isset($data['calificaciones']) || ($data['calificaciones'] == '')) $data['calificaciones'] = "false"; }    
    if(array_key_exists('asistencia', $data)) { if(!isset($data['asistencia']) || ($data['asistencia'] == '')) $data['asistencia'] = "false"; }    
    if(array_key_exists('temas_tratados', $data)) { if(!isset($data['temas_tratados']) || ($data['temas_tratados'] == '')) $data['temas_tratados'] = "false"; }    
    if(array_key_exists('calificaciones_digital', $data)) { if(!isset($data['calificaciones_digital']) || ($data['calificaciones_digital'] == '')) $data['calificaciones_digital'] = "false"; }    
    if(array_key_exists('toma', $data)) { if(!isset($data['toma']) || ($data['toma'] == '')) throw new Exception('dato obligatorio sin valor: toma'); }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $this->sql = new SqlFormat($this->db);
    $row_ = array();
    $row_['id'] = $this->sql->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['fecha_recepcion'])) $row_['fecha_recepcion'] = $this->sql->date($row['fecha_recepcion']);
    if(isset($row['calificaciones'])) $row_['calificaciones'] = $this->sql->boolean($row['calificaciones']);
    if(isset($row['asistencia'])) $row_['asistencia'] = $this->sql->boolean($row['asistencia']);
    if(isset($row['temas_tratados'])) $row_['temas_tratados'] = $this->sql->boolean($row['temas_tratados']);
    if(isset($row['calificaciones_digital'])) $row_['calificaciones_digital'] = $this->sql->boolean($row['calificaciones_digital']);
    if(isset($row['toma']) ) $row_['toma'] = $this->sql->positiveIntegerWithoutZerofill($row['toma']);

    return $row_;
  }

  //@override
  protected function _build(array $row, $prefix = ""){
    if(empty($row)) return null;
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : intval($row[$prefix . "id"]);
    $row_["fecha_recepcion"] = (is_null($row[$prefix . "fecha_recepcion"])) ? null : (string)$row[$prefix . "fecha_recepcion"];
    $row_["calificaciones"] = (is_null($row[$prefix . "calificaciones"])) ? null : settypebool($row[$prefix . "calificaciones"]);
    $row_["asistencia"] = (is_null($row[$prefix . "asistencia"])) ? null : settypebool($row[$prefix . "asistencia"]);
    $row_["temas_tratados"] = (is_null($row[$prefix . "temas_tratados"])) ? null : settypebool($row[$prefix . "temas_tratados"]);
    $row_["calificaciones_digital"] = (is_null($row[$prefix . "calificaciones_digital"])) ? null : settypebool($row[$prefix . "calificaciones_digital"]);
    $row_["toma"] = (is_null($row[$prefix . "toma"])) ? null : intval($row[$prefix . "toma"]);
    return $row_;
  }
  
  //@override
  public function build(array $row){
    if(empty($row)) return null;
    $row_ = $this->_build($row);
    if(!empty($row["tom_id"])){
      $sqlo = new TomaSqlo;
      $row_["toma_"] = $sqlo->_build($row, "tom_");
    }
    if(!empty($row["tom_cur_id"])){
      $sqlo = new CursoSqlo;
      $row_["toma_"]["curso_"] = $sqlo->_build($row, "tom_cur_");
    }
    if(!empty($row["tom_cur_com_id"])){
      $sqlo = new ComisionSqlo;
      $row_["toma_"]["curso_"]["comision_"] = $sqlo->_build($row, "tom_cur_com_");
    }
    if(!empty($row["tom_cur_com_cs_id"])){
      $sqlo = new ComisionSqlo;
      $row_["toma_"]["curso_"]["comision_"]["comision_siguiente_"] = $sqlo->_build($row, "tom_cur_com_cs_");
    }
    if(!empty($row["tom_cur_com_cs_div_id"])){
      $sqlo = new DivisionSqlo;
      $row_["toma_"]["curso_"]["comision_"]["comision_siguiente_"]["division_"] = $sqlo->_build($row, "tom_cur_com_cs_div_");
    }
    if(!empty($row["tom_cur_com_cs_div_pla_id"])){
      $sqlo = new PlanSqlo;
      $row_["toma_"]["curso_"]["comision_"]["comision_siguiente_"]["division_"]["plan_"] = $sqlo->_build($row, "tom_cur_com_cs_div_pla_");
    }
    if(!empty($row["tom_cur_com_cs_div_sed_id"])){
      $sqlo = new SedeSqlo;
      $row_["toma_"]["curso_"]["comision_"]["comision_siguiente_"]["division_"]["sede_"] = $sqlo->_build($row, "tom_cur_com_cs_div_sed_");
    }
    if(!empty($row["tom_cur_com_cs_div_sed_dom_id"])){
      $sqlo = new DomicilioSqlo;
      $row_["toma_"]["curso_"]["comision_"]["comision_siguiente_"]["division_"]["sede_"]["domicilio_"] = $sqlo->_build($row, "tom_cur_com_cs_div_sed_dom_");
    }
    if(!empty($row["tom_cur_com_div_id"])){
      $sqlo = new DivisionSqlo;
      $row_["toma_"]["curso_"]["comision_"]["division_"] = $sqlo->_build($row, "tom_cur_com_div_");
    }
    if(!empty($row["tom_cur_com_div_pla_id"])){
      $sqlo = new PlanSqlo;
      $row_["toma_"]["curso_"]["comision_"]["division_"]["plan_"] = $sqlo->_build($row, "tom_cur_com_div_pla_");
    }
    if(!empty($row["tom_cur_com_div_sed_id"])){
      $sqlo = new SedeSqlo;
      $row_["toma_"]["curso_"]["comision_"]["division_"]["sede_"] = $sqlo->_build($row, "tom_cur_com_div_sed_");
    }
    if(!empty($row["tom_cur_com_div_sed_dom_id"])){
      $sqlo = new DomicilioSqlo;
      $row_["toma_"]["curso_"]["comision_"]["division_"]["sede_"]["domicilio_"] = $sqlo->_build($row, "tom_cur_com_div_sed_dom_");
    }
    if(!empty($row["tom_cur_ch_id"])){
      $sqlo = new CargaHorariaSqlo;
      $row_["toma_"]["curso_"]["carga_horaria_"] = $sqlo->_build($row, "tom_cur_ch_");
    }
    if(!empty($row["tom_cur_ch_asi_id"])){
      $sqlo = new AsignaturaSqlo;
      $row_["toma_"]["curso_"]["carga_horaria_"]["asignatura_"] = $sqlo->_build($row, "tom_cur_ch_asi_");
    }
    if(!empty($row["tom_cur_ch_pla_id"])){
      $sqlo = new PlanSqlo;
      $row_["toma_"]["curso_"]["carga_horaria_"]["plan_"] = $sqlo->_build($row, "tom_cur_ch_pla_");
    }
    if(!empty($row["tom_pro_id"])){
      $sqlo = new IdPersonaSqlo;
      $row_["toma_"]["profesor_"] = $sqlo->_build($row, "tom_pro_");
    }
    if(!empty($row["tom_pro_alumper_id"])){
      $sqlo = new AlumnoSqlo;
      $row_["toma_"]["profesor_"]["alumper_"] = $sqlo->_build($row, "tom_pro_alumper_");
    }
    if(!empty($row["tom_ree_id"])){
      $sqlo = new IdPersonaSqlo;
      $row_["toma_"]["reemplaza_"] = $sqlo->_build($row, "tom_ree_");
    }
    if(!empty($row["tom_ree_alumper_id"])){
      $sqlo = new AlumnoSqlo;
      $row_["toma_"]["reemplaza_"]["alumper_"] = $sqlo->_build($row, "tom_ree_alumper_");
    }
    return $row_;
  }
  

}
