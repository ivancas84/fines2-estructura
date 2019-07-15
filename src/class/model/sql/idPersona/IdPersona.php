<?php

require_once("class/model/sql/idPersona/Main.php");

class IdPersonaSql extends IdPersonaSqlMain {

  public function _subSql(Render $render){ //subconsulta sql (en construccion)
    $t = $this->prt();
    return "SELECT * FROM (

SELECT DISTINCT {$this->_fieldsDb()}, telefonos.telefonos
{$this->_from($render)}
LEFT JOIN (
    SELECT id_persona.id AS persona, GROUP_CONCAT(telefono.prefijo, \" \", telefono.numero, \" (\", telefono.tipo, \")\") AS telefonos
    FROM id_persona
    INNER JOIN telefono ON (telefono.persona = id_persona.id)
    WHERE telefono.baja IS NULL
    GROUP BY persona
) AS telefonos ON (telefonos.persona = {$t}.id)

) AS {$t}
" . concat($this->_condition($render), 'WHERE ') . "
";
  }

  public function _mappingField($field) {
    $p = $this->prf();
    
    switch ($field) {
      case $p.'_numero_documento': //utilizado solo para ordenamiento    
        $f = parent::_mappingField($p."numero_documento");
        return "CAST({$f} AS UNSIGNED)";
      
      default: return parent::_mappingField($field);
    }
  }
}
