<?php

require_once("class/model/Sqlo.php");
require_once("class/db/SqlFormat.php");

//Implementacion principal de Sqlo para una entidad especifica
class ArchivoPersonaSqloMain extends EntitySqlo {

  //Constructor
  //Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
  public function __construct(){
    $this->entity = new ArchivoPersonaEntity;
    $this->sql = new ArchivoPersonaSql($this->entity);
  }

  //@override
  protected function _insert(array $row){
    $sql = "
INSERT INTO " . $this->entity->sn_() . " (";
    $sql .= "id, " ;
    $sql .= "alta, " ;
    $sql .= "baja, " ;
    $sql .= "persona, " ;
    $sql .= "archivo, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma    

    $sql .= ") 
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['alta'] . ", " ;
    $sql .= $row['baja'] . ", " ;
    $sql .= $row['persona'] . ", " ;
    $sql .= $row['archivo'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma    

    $sql .= ");
";
  
    return $sql;
  }

  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : $this->nextPk();
    if(!isset($data['alta']))  $data['alta'] = date("Y-m-d H:i:s");
    if(!isset($data['baja']))  $data['baja'] = "null";
    if(!isset($data['persona']) || ($data['persona'] == '')) throw new Exception('dato obligatorio sin valor: persona');
    if(!isset($data['archivo']) || ($data['archivo'] == '')) throw new Exception('dato obligatorio sin valor: archivo');

    return $data;
  }

  //@override
  protected function _update(array $row){
    $sql = "
UPDATE " . $this->entity->sn_() . " SET 
"; 
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    if (isset($row['baja'] )) $sql .= "baja = " . $row['baja'] . " ," ;
    if (isset($row['persona'] )) $sql .= "persona = " . $row['persona'] . " ," ;
    if (isset($row['archivo'] )) $sql .= "archivo = " . $row['archivo'] . " ," ;
    //eliminar ultima coma    
    $sql = substr($sql, 0, -2);

        
    $sql .= "
WHERE id = " . $row['id'] . ";
"; 
  
    return $sql;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('alta', $data)) { if(empty($data['alta']))  $data['alta'] = date("Y-m-d H:i:s"); }
    if(array_key_exists('baja', $data)) { if(empty($data['baja']))  $data['baja'] = "null"; }
    if(array_key_exists('persona', $data)) { if(!isset($data['persona']) || ($data['persona'] == '')) throw new Exception('dato obligatorio sin valor: persona'); }
    if(array_key_exists('archivo', $data)) { if(!isset($data['archivo']) || ($data['archivo'] == '')) throw new Exception('dato obligatorio sin valor: archivo'); }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $this->sql = new SqlFormat($this->db);
    $row_ = array();
    $row_['id'] = $this->sql->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['alta'])) $row_['alta'] = $this->sql->timestamp($row['alta']);
    if(isset($row['baja'])) $row_['baja'] = $this->sql->timestamp($row['baja']);
    if(isset($row['persona']) ) $row_['persona'] = $this->sql->positiveIntegerWithoutZerofill($row['persona']);
    if(isset($row['archivo']) ) $row_['archivo'] = $this->sql->positiveIntegerWithoutZerofill($row['archivo']);

    return $row_;
  }

  //@override
  protected function _build(array $row, $prefix = ""){
    if(empty($row)) return null;
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : intval($row[$prefix . "id"]);
    $row_["alta"] = (is_null($row[$prefix . "alta"])) ? null : (string)$row[$prefix . "alta"];
    $row_["baja"] = (is_null($row[$prefix . "baja"])) ? null : (string)$row[$prefix . "baja"];
    $row_["persona"] = (is_null($row[$prefix . "persona"])) ? null : intval($row[$prefix . "persona"]);
    $row_["archivo"] = (is_null($row[$prefix . "archivo"])) ? null : intval($row[$prefix . "archivo"]);
    return $row_;
  }
  
  //@override
  public function build(array $row){
    if(empty($row)) return null;
    $row_ = $this->_build($row);
    if(!empty($row["per_id"])){
      $sqlo = new IdPersonaSqlo;
      $row_["persona_"] = $sqlo->_build($row, "per_");
    }
    if(!empty($row["per_alumper_id"])){
      $sqlo = new AlumnoSqlo;
      $row_["persona_"]["alumper_"] = $sqlo->_build($row, "per_alumper_");
    }
    if(!empty($row["arc_id"])){
      $sqlo = new ArchivoSqlo;
      $row_["archivo_"] = $sqlo->_build($row, "arc_");
    }
    return $row_;
  }
  

}
