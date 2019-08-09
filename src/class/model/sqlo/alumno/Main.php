<?php

require_once("class/model/Sqlo.php");

//Implementacion principal de Sqlo para una entidad especifica
class AlumnoSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceFromString('alumno');
    $this->sql = EntitySql::getInstanceFromString('alumno');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "fotocopia_documento, " ;
    $sql .= "partida_nacimiento, " ;
    $sql .= "constancia_cuil, " ;
    $sql .= "certificado_estudios, " ;
    $sql .= "anio_ingreso, " ;
    $sql .= "observaciones, " ;
    $sql .= "persona, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['fotocopia_documento'] . ", " ;
    $sql .= $row['partida_nacimiento'] . ", " ;
    $sql .= $row['constancia_cuil'] . ", " ;
    $sql .= $row['certificado_estudios'] . ", " ;
    $sql .= $row['anio_ingreso'] . ", " ;
    $sql .= $row['observaciones'] . ", " ;
    $sql .= $row['persona'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['fotocopia_documento'] )) $sql .= "fotocopia_documento = " . $row['fotocopia_documento'] . " ," ;
    if (isset($row['partida_nacimiento'] )) $sql .= "partida_nacimiento = " . $row['partida_nacimiento'] . " ," ;
    if (isset($row['constancia_cuil'] )) $sql .= "constancia_cuil = " . $row['constancia_cuil'] . " ," ;
    if (isset($row['certificado_estudios'] )) $sql .= "certificado_estudios = " . $row['certificado_estudios'] . " ," ;
    if (isset($row['anio_ingreso'] )) $sql .= "anio_ingreso = " . $row['anio_ingreso'] . " ," ;
    if (isset($row['observaciones'] )) $sql .= "observaciones = " . $row['observaciones'] . " ," ;
    if (isset($row['persona'] )) $sql .= "persona = " . $row['persona'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['per_id'])){
      $json = EntitySql::getInstanceFromString('id_persona', 'per')->_json($row);
      $row_["persona_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $json = ($row && !is_null($row['id'])) ? $this->sql->_json($row) : null;
    $row_["alumno"] = EntityValues::getInstanceFromString("alumno", $json);

    $json = ($row && !is_null($row['per_id'])) ? EntitySql::getInstanceFromString('id_persona', 'per')->_json($row) : null;
    $row_["persona"] = EntityValues::getInstanceFromString('id_persona', $json);

    return $row_;
  }



}
