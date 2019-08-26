<?php

require_once("class/model/sqlo/idPersona/Main.php");
require_once("class/model/Data.php");

//***** implementacion de Sqlo para una determinada tabla *****
class IdPersonaSqlo extends IdPersonaSqloMain{

  public function docentesAll($render = NULL) { //retorna todas las personas que son docentes
    $r = $this->render($render);

    $sql = "SELECT DISTINCT
  {$this->sql->fieldsFull()}
  {$this->sql->from()}
  {$this->sql->join()}
  {$this->sql->innerJoin("profesor", "toma")}
  " . concat($this->_condition($render), 'WHERE ') . "
  {$this->sql->orderBy($r->getOrder())}
  {$this->sql->limit($r->getPage(), $r->getSize())}
";

    return $sql;
  }

  public function alumnosAll($render = NULL) { //retorna todas las personas que son alumnos
    $r = $this->render($render);

    $sql = "SELECT DISTINCT
  {$this->sql->fieldsFull()}
  {$this->sql->from()}
  {$this->sql->join()}
  {$this->sql->innerJoin("persona", "nomina2")}
  " . concat($this->_condition($render), 'WHERE ') . "
  {$this->sql->orderBy($r->getOrder())}
  {$this->sql->limit($r->getPage(), $r->getSize())}
";

    return $sql;
  }

  public function coordinadoresAll($render = NULL) { //devolver todas las personas que son coordinadores
    $r = $this->render($render);

    $sql = "SELECT DISTINCT
  {$this->sql->fieldsFull()}
  {$this->sql->from()}
  {$this->sql->join()}
  {$this->sql->innerJoin("persona", "coordinador")}
  {concat($this->_condition($r), 'WHERE ')}
  {$this->sql->orderBy($r->getOrder())}
  {$this->sql->limit($r->getPage(), $r->getSize())}
";

    return $sql;
  }

  public function coordinadoresCount($render = NULL) { //sql cantidad de valores
    $r = $this->render($render);

    return "
SELECT count(DISTINCT " . $this->sql->fieldId() . ") AS \"num_rows\"
{$this->sql->from()}
{$this->sql->join()}
{$this->sql->innerJoin("persona", "coordinador")}
{concat($this->_condition($r), 'WHERE ')}
";
  }

  public function cantidadAlumnosComisiones($fecha, $render = NULL){
    $r = $this->render($render);
    $sqlCoordinadores = EntitySqlo::getInstanceString("coordinador")->cantidadAlumnos($fecha);
    $sqlCantidadComisiones = EntitySqlo::getInstanceString("coordinador")->cantidadComisiones($fecha);

    $sql = "SELECT DISTINCT
{$this->sql->fieldsFull()}, cantidad_alumnos.cantidad_activos, cantidad_alumnos.cantidad_no_activos, cantidad_comisiones.cantidad_comisiones
{$this->sql->from()}
{$this->sql->join()}
INNER JOIN ({$sqlCoordinadores}) AS cantidad_alumnos ON (cantidad_alumnos.persona = ip.id)
INNER JOIN ({$sqlCantidadComisiones}) AS cantidad_comisiones ON (cantidad_comisiones.persona = ip.id)
{concat($this->_condition($r), 'WHERE ')}
{$this->sql->orderBy($r->getOrder())}
{$this->sql->limit($r->getPage(), $r->getSize())}
";

    return $sql;
  }

  public function cantidadComisionesTramo($fecha, $render){
    $r = $this->render($render);
    $sqlCantidadComisionesTramo = EntitySqlo::getInstanceString("coordinador")->cantidadComisionesTramo($fecha);
  }

  public function idFechaToma($fechaToma, $render = null){
    return "
SELECT DISTINCT id_persona.id
FROM id_persona
INNER JOIN toma ON (toma.profesor = id_persona.id)
INNER JOIN curso ON (toma.curso = curso.id)
INNER JOIN comision ON (curso.comision = comision.id)
INNER JOIN division ON (comision.division = division.id)
WHERE division.plan = 3
AND toma.fecha_toma = '{$fechaToma}'
";
  }

  public function allFechaToma($fechaToma, $render = null) {
    $r = $this->render($render);

    $sqlCondAux = $this->sql->fieldId() . " IN (" . $this->idFechaToma($fechaToma, $render) . ")";
    $sqlCond = $this->_condition($render);
    $sqlCond = concat($sqlCondAux, " AND", " WHERE", $sqlCond);

    return "SELECT DISTINCT
{$this->sql->fieldsFull()}
{$this->sql->from()}
{$this->sql->join()}
{$sqlCond}
{$this->sql->orderBy($r->getOrder())}
{$this->sql->limit($r->getPage(), $r->getSize())}
";
  }














  public function idCantidadSedesFiltros($fechaAnio, $fechaSemestre, $dependencia, array $planes) {
    /**
     * id y cantidad de sedes con comisiones autorizadas de un coordinador en un tramo
     */
    $sub = SedeSqlo::getInstance()->ids(["_filtros","=",["fecha_anio" => $fechaAnio, "fecha_semestre" => $fechaSemestre, "dependencia" => $dependencia, "plan" =>$planes]]);

    return "
SELECT coordinador.persona AS id, count(coordinador.sede) AS cantidad
FROM coordinador
WHERE coordinador.sede IN ({$sub})
AND coordinador.baja IS NULL
GROUP BY coordinador.persona
";
  }

  public function idCantidadSedesNoAutorizadasFiltros($fechaAnio, $fechaSemestre, $dependencia, $planes) {
    /**
     * id y cantidad de sedes con comisiones no autorizadas de un coordinador en un tramo
     */
    $sub = SedeSqlo::getInstance()->ids(["_filtros","=",["fecha_anio" => $fechaAnio, "fecha_semestre" => $fechaSemestre, "dependencia" => $dependencia, "plan" =>$planes, "autorizada" => false]]);

    //$sub = SedeSqlo::getInstance()->idNoAutorizadasFiltros($fechaAnio, $fechaSemestre, $dependencia, $planes);

    return "
SELECT coordinador.persona AS id, count(coordinador.sede) AS cantidad
FROM coordinador
WHERE coordinador.sede IN ({$sub})
AND coordinador.baja IS NULL
GROUP BY coordinador.persona
";
  }

  public function idCantidadComisionesFiltros($fechaAnio, $fechaSemestre, $dependencia, array $planes) {
    /**
     * id y cantidad de comisiones autorizadas de un coordinador en un tramo
     */

     $condicionFiltros = Data::condicionFiltros($fechaAnio, $fechaSemestre, $dependencia, $planes);

    return "
SELECT DISTINCT coordinador.persona AS id, count(*) AS cantidad
FROM coordinador
INNER JOIN sede ON (coordinador.sede = sede.id)
INNER JOIN division ON (division.sede = sede.id)
INNER JOIN comision ON (comision.division = division.id)
WHERE {$condicionFiltros}
AND comision.autorizada
AND coordinador.baja IS NULL
GROUP BY id
  ";
  }


  public function idCantidadComisionesNoAutorizadasFiltros($fechaAnio, $fechaSemestre, $dependencia, array $planes) {
    /**
     * id y cantidad de comisiones autorizadas de un coordinador en un tramo
     */
     $condicionFiltros = Data::condicionFiltros($fechaAnio, $fechaSemestre, $dependencia, $planes);

    return "
SELECT DISTINCT coordinador.persona AS id, count(*) AS cantidad
FROM coordinador
INNER JOIN sede ON (coordinador.sede = sede.id)
INNER JOIN division ON (division.sede = sede.id)
INNER JOIN comision ON (comision.division = division.id)
WHERE {$condicionFiltros}
AND NOT comision.autorizada
AND coordinador.baja IS NULL
GROUP BY id
";
  }





  public function idCantidadAlumnosActivosFiltros($fechaAnio, $fechaSemestre, $dependencia, array $planes) {
    /**
     * id y cantidad de alumnos activos de un coordinador en un tramo de comisiones autorizadas
     */
    $filtros = [
      "fecha_anio" => $fechaAnio,
      "fecha_semestre" => $fechaSemestre,
      "dependencia" => $dependencia,
      "plan" => $planes,
    ];
    $sql = Nomina2Sqlo::getInstance()->idsActivosFiltros($filtros);
    $condicionFiltros = Data::condicionFiltros($filtros);

    return "
SELECT DISTINCT coordinador.persona AS id, count(*) AS cantidad
FROM coordinador
INNER JOIN sede ON (coordinador.sede = sede.id)
INNER JOIN division ON (division.sede = sede.id)
INNER JOIN comision ON (comision.division = division.id)
LEFT JOIN nomina2 ON (nomina2.comision = comision.id)
INNER JOIN ({$sql}) AS nomina_activos ON (nomina_activos.id = nomina2.id)
WHERE ({$condicionFiltros})
AND coordinador.baja IS NULL
GROUP BY id
";
  }


    public function idInfoCoordinadoresFiltros($fechaAnio, $fechaSemestre, $dependencia, array $planes) {
      /**
       * id de coordinador, cantidad de alumnos activos, cantidad de sedes activas y cantidad de comisiones activas en un tramo  determinado
       */

       $sub1 = $this->idCantidadSedesFiltros($fechaAnio, $fechaSemestre, $dependencia, $planes);
       $sub2 = $this->idCantidadComisionesFiltros($fechaAnio, $fechaSemestre, $dependencia, $planes);
       $sub3 = $this->idCantidadAlumnosActivosFiltros($fechaAnio, $fechaSemestre, $dependencia, $planes);
       $sub4 = $this->idCantidadComisionesNoAutorizadasFiltros($fechaAnio, $fechaSemestre, $dependencia, $planes);
       $sub5 = $this->idCantidadSedesNoAutorizadasFiltros($fechaAnio, $fechaSemestre, $dependencia, $planes);

       $condicionFiltros = Data::condicionFiltros($fechaAnio, $fechaSemestre, $dependencia, $planes);

       return "
SELECT coordinador.persona AS id,
sub1.cantidad AS cantidad_sedes,
sub2.cantidad AS cantidad_comisiones,
sub3.cantidad AS cantidad_alumnos,
sub4.cantidad AS cantidad_comisiones_no_autorizadas,
sub5.cantidad AS cantidad_sedes_no_autorizadas
FROM coordinador
LEFT JOIN ({$sub1}) AS sub1 ON (sub1.id = coordinador.persona)
LEFT JOIN ({$sub2}) AS sub2 ON (sub2.id = coordinador.persona)
LEFT JOIN ({$sub3}) AS sub3 ON (sub3.id = coordinador.persona)
LEFT JOIN ({$sub4}) AS sub4 ON (sub4.id = coordinador.persona)
LEFT JOIN ({$sub5}) AS sub5 ON (sub5.id = coordinador.persona)
WHERE coordinador.sede IN (
  SELECT DISTINCT sede.id AS sede
  FROM sede
  INNER JOIN division ON (division.sede = sede.id)
  INNER JOIN comision ON (comision.division = division.id)
  WHERE ({$condicionFiltros})
  AND coordinador.baja IS NULL
)
GROUP BY coordinador.persona
";

    }


    public function alumnosRepetidosPeriodo($fechaAnio, $fechaSemestre){ //id de alumno repetido y cantidad de repeticiones en un periodo
      //@todo esta consulta puede ser reemplazada por una consulta avanzada
      /**
       * No define filtros debido a que involucra a todas las dependencias y planes
       */
      return "SELECT persona AS id, COUNT(*) as cantidad
FROM nomina2
INNER JOIN comision ON (nomina2.comision = comision.id)
WHERE nomina2.activo
AND comision.fecha_anio = '{$fechaAnio}'
AND comision.fecha_semestre = {$fechaSemestre}
GROUP BY persona
HAVING cantidad > 1
";


    }

}
