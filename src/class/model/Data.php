<?php

require_once("class/model/Dba.php");
require_once("class/model/Render.php");
require_once("class/model/RenderAux.php");
require_once("class/model/Sqlo.php");


class Data {

  
  public static function alumnosActivosRepetidosFiltros($fechaAnio, $fechaSemestre, $clasificacion, $dependencia){
    $render = new RenderAux();
    $render->setAggregate(["_count"]);
    $render->setGroup(["persona"]);
    $render->setHaving(["_count",">",1]);
    $render->setCondition([
      ["com_fecha_anio","=",$fechaAnio],
      ["com_fecha_semestre",">",$fechaSemestre],
      ["com_autorizada", "=", true],
      ["com_dvi_sed_dependencia", "=", $dependencia],
      ["activo","=",true]
      
    ]);
    $render->setGeneralCondition([
      ["com_dvi__clasificacion_nombre", "=", $clasificacion]
    ]);
    
    $sql = EntitySqlo::getInstanceRequire("nomina2")->advanced($render);
    return Dba::fetchAll($sql);
  }


  public static function alumnosActivosTodos1RepetidosFiltros($fechaAnio, $fechaSemestre, $clasificacion, $dependencia){
    $render = new RenderAux();
    $render->setAggregate(["_count"]);
    $render->setGroup(["persona"]);
    $render->setHaving(["_count",">",1]);
    $render->setCondition([
      ["com_fecha_anio","=",$fechaAnio],
      ["com_fecha_semestre","=",$fechaSemestre],
      ["com_autorizada", "=", true],
      ["com_dvi_sed_dependencia", "=", $dependencia],      
    ]);
    $render->setGeneralCondition([
      ["com_dvi__clasificacion_nombre", "=", $clasificacion],
      [
        ["activo","=",true, "AND"],
        ["com_anio","=","1", "OR"]
      ]
    ]);
    
    return EntitySqlo::getInstanceRequire("nomina2")->advanced($render);
  
  }

  public static function nominaFiltrosPersonas($fechaAnio, $fechaSemestre, $clasificacion, $dependencia, $personas){
    $render = new Render();
    $render->setCondition([
      ["com_fecha_anio","=",$fechaAnio],
      ["com_fecha_semestre","=",$fechaSemestre],
      ["com_autorizada", "=", true],
      ["com_dvi_sed_dependencia", "=", $dependencia],
      ["persona","=",$personas],
      ["activo","=",true]
    ]);
    $render->setGeneralCondition([
      ["com_dvi__clasificacion_nombre", "=", $clasificacion]
    ]);
    $render->setOrder(["per_apellidos" => "asc", "per_nombres"=>"asc"]);
    
    return EntitySqlo::getInstanceRequire("nomina2")->all($render);
  }

  public static function nominaActivosTodos1FiltrosSinPersonas($fechaAnio, $fechaSemestre, $clasificacion, $dependencia, $personas){
    $render = new Render();
    $render->setCondition([
      ["com_fecha_anio","=",$fechaAnio],
      ["com_fecha_semestre","=",$fechaSemestre],
      ["com_autorizada", "=", true],
      ["com_dvi_sed_dependencia", "=", $dependencia],
    ]);

    if(!empty($personas)) $render->addCondition(["persona","!=",$personas]);

    $render->setGeneralCondition([
      ["com_dvi__clasificacion_nombre", "=", $clasificacion],
      [
        ["activo","=",true, "AND"],
        ["com_anio","=","1", "OR"]
      ]
    ]);

    $render->setOrder(
      ["com_dvi_sed_numero"=>"asc", "com_anio" => "asc", "com_semestre" => "asc", "com_dvi_numero" => "asc", "per_apellidos" => "asc", "per_nombres" => "asc"]
    );
    
    return EntitySqlo::getInstanceRequire("nomina2")->all($render);
  }


  public static function contralor($fechaAnio, $fechaSemestre, $clasificacion, $fechaEntradaContralor = null, $fechaAlta = null){
    $render = new Render();
    $render->setCondition([
        ["cur_com_dvi__clasificacion_nombre", "=", $clasificacion],
        ["cur_com_fecha_anio", "=", $fechaAnio],
        ["cur_com_fecha_semestre", "=", $fechaSemestre],
        [
            ["estado","=","Aprobada"],
            ["estado","=","Renuncia","OR"],
            ["estado","=","Baja","OR"],
        ],
        ["profesor","=",true],
        ["estado_contralor","=","Pasar"],
        ["fecha_entrada_contralor","=",$fechaEntradaContralor]
    ]);
    if($fechaAlta) $render->addCondition(["alta","<",$fechaAlta]);
    $render->setOrder(["pro__numero_documento" => "ASC"]);
    return EntitySqlo::getInstanceRequire("toma")->all($render);
  }

  public static function contralorRenunciasPendientes($fechaAnio, $fechaSemestre){
    $render = new Render();
    $render->setCondition([
        ["cur_com_fecha_anio", "=", $fechaAnio],
        ["cur_com_fecha_semestre", "=", $fechaSemestre],
        ["cur_toma_activa", "=", false],
        ["estado","=","Renuncia"],
    ]);
    return EntitySqlo::getInstanceRequire("toma")->all($render);
  }

  public static function contralorControlFechaAprobada($fechaAnio, $fechaSemestre, $clasificacion, $fechaInicio, $fechaFin){
    /**
     * Deberia tener dependencia tambien, pero por el momento no se define ya que los datos solo estan para el cens 456
     */
    $render = new Render();
    $render->setCondition([
        ["cur_com_dvi__clasificacion_nombre", "=", $clasificacion],
        ["cur_com_fecha_anio", "=", $fechaAnio],
        ["cur_com_fecha_semestre", "=", $fechaSemestre],
        [
            ["estado","=","Aprobada"],
            ["estado","=","Pendiente","OR"],
        ],
        ["profesor","=",true],
        [
          ["fecha_inicio","!=",$fechaInicio],
          ["fecha_fin","!=",$fechaFin, "OR"],
          ["fecha_toma",">",$fechaFin, "OR"],
        ],
        ["estado_contralor","=","Pasar"]
    ]);
    $render->setOrder(["pro__numero_documento" => "ASC"]);
    return EntitySqlo::getInstanceRequire("toma")->all($render);
  }

  public static function contralorControlFechaRenuncia($fechaAnio, $fechaSemestre, $clasificacion){
    /**
     * Deberia tener dependencia tambien, pero por el momento no se define ya que los datos solo estan para el cens 456
     */
    $render = new Render();
    $render->setCondition([
      ["cur_com_dvi__clasificacion_nombre", "=", $clasificacion],
      ["cur_com_fecha_anio", "=", $fechaAnio],
      ["cur_com_fecha_semestre", "=", $fechaSemestre],
      [
        ["estado","=","Renuncia"],
        ["estado","=","Baja","OR"]
      ],
      ["profesor","=",true],
      ["estado_contralor","=","Pasar"]
    ]);
    $render->setGeneralCondition([[
      ["_compare","!=", ["fecha_toma","fecha_inicio"]],
      ["_compare","!=", ["fecha_toma","fecha_fin"], "OR"]
    ]]);
    $render->setOrder(["pro__numero_documento" => "ASC"]);
    return EntitySqlo::getInstanceRequire("toma")->all($render);
  }









  public static function condicionFiltros_($filtros, $id = "id", $opt = "IN"){
    $fechaAnio = $filtros["fecha_anio"];
    $fechaSemestre = $filtros["fecha_semestre"];
    
    $planes = is_array($filtros["plan"]) ? $filtros["plan"] : [$filtros["plan"]];
    $planes_ = implode(", ", $planes);
    
    if(key_exists("dependencia", $filtros) && !empty($filtros["dependencia"])) {
      $dependencias = is_array($filtros["dependencia"]) ? $filtros["dependencia"] : [$filtros["dependencia"]];
      $dependencias_ = implode(", ", $dependencias);
      $sqlDependencia = "  AND (
        sede.dependencia IN ({$dependencias_})
        OR sede.id IN ({$dependencias_})
      )";  
    } else $sqlDependencia = ""; 

    $autorizada = key_exists("autorizada", $filtros) ? settypebool($filtros["autorizada"]) : null;
    if(!is_null($autorizada)) $sqlAutorizada = ($autorizada) ? "AND comision.autorizada" : "AND !comision.autorizada";
    else $sqlAutorizada = "";

    return "{$id} {$opt} (
  SELECT sede.id
  FROM sede
  INNER JOIN division ON (division.sede = sede.id)
  INNER JOIN comision ON (comision.division = division.id)
  WHERE comision.fecha_anio = '{$fechaAnio}'
  AND comision.fecha_semestre = {$fechaSemestre}
  AND division.plan IN ({$planes_})
  {$sqlDependencia}
  {$sqlAutorizada}
)
";
  }

  public static function condicionFiltros($fechaAnio, $fechaSemestre, array $dependencia, array $planes){ //condicion de filtros habitualmente utilizada
    $planes_ = implode(", ", $planes);

    return "(
  comision.fecha_anio = '{$fechaAnio}'
  AND comision.fecha_semestre = {$fechaSemestre}
  AND division.plan IN ({$planes_})
  AND (
    sede.dependencia = {$dependencia}
    OR sede.id = {$dependencia}
  )
)
";
  }



  protected static function asignarCantidadAComisiones(&$comisiones, $cantidades, $fieldName = "cantidad"){
    foreach($comisiones as &$comision){
      foreach($cantidades as $cantidad){
        if($comision["id"] == $cantidad["comision"]){
          $comision[$fieldName] = $cantidad["cantidad"];
        }
      }
    }
  }


  public static function sqlcomisionesPublicadas($fecha, $orden = "tramo"){
    $render = new Render();
    $advanced = EntitySql::getInstanceString("comision")->_advancedComisionesPublicadas($fecha);
    $render->setCondition($advanced);

    $o = ($orden == "tramo") ? ["anio"=>"asc", "semestre"=>"asc", "dvi_sed_numero"=>"asc"] : ["dvi_sed_numero"=>"asc", "anio"=>"asc", "semestre"=>"asc"];
    $render->setOrder($o);

    return EntitySqlo::getInstanceString("comision")->all($render);
  }


  public static function comisionesPublicadas($fecha, $orden = "tramo"){
    $render = new Render();
    $advanced = EntitySql::getInstanceString("comision")->_advancedComisionesPublicadas($fecha);
    $render->setCondition($advanced);

    $o = ($orden == "tramo") ? ["anio"=>"asc", "semestre"=>"asc", "dvi_sed_numero"=>"asc"] : ["dvi_sed_numero"=>"asc", "anio"=>"asc", "semestre"=>"asc"];
    $render->setOrder($o);

    return Dba::all("comision",$render);
  }

  public static function comisionesPublicadasPorCoordinador($fecha, $orden = "tramo"){
    $sqlComisionesPublicadas = self::sqlcomisionesPublicadas($fecha, $orden);
    echo "SELECT coordinador.id AS coordinador, comisiones_publicadas.*, cantidad_alumnos_activos.cantidad
FROM coordinador
INNER JOIN sede ON (coordinador.sede = sede.id)
INNER JOIN division ON (division.sede = sede.id)
INNER JOIN ({$sqlComisionesPublicadas}) AS comisiones_publicadas ON (comisiones_publicadas.division = division.id)
LEFT JOIN (" . EntitySqlo::getInstanceString("comision")->cantidadAlumnosActivos($fecha) . ") AS cantidad_alumnos_activos ON (cantidad_alumnos_activos.comision = comisiones_publicadas.id);
";
  }

  public static function comisionesPublicadasCantidadAlumnos($fecha, $orden = "tramo"){
    $comisiones = self::comisionesPublicadas($fecha, $orden);

    $sql = EntitySqlo::getInstanceString("comision")->cantidadAlumnosActivos($fecha);
    $cantidadActivos = Dba::fetchAll($sql);

    $sql = EntitySqlo::getInstanceString("comision")->cantidadAlumnosNoActivos($fecha);
    $cantidadNoActivos = Dba::fetchAll($sql);

    self::asignarCantidadAComisiones($comisiones, $cantidadActivos, "cantidad_activos");
    self::asignarCantidadAComisiones($comisiones, $cantidadNoActivos, "cantidad_no_activos");
    return $comisiones;
  }

  public static function nominaActivos($fecha){
    $render = new Render();
    $render->setOrder(["com_dvi_sed_numero"=>"asc", "com_anio" => "asc", "com_semestre" => "asc", "com_dvi_numero" => "asc", "per_apellidos" => "asc", "per_nombres" => "asc"]);
    $sql = EntitySqlo::getInstanceString("nomina2")->activos($fecha, $render);
    $rows = Dba::fetchAll($sql);
    return EntitySql::getInstanceString("nomina2")->jsonAll($rows);
  }

  public static function nominaActivosGraduados($fecha){
    $render = new Render();
    $render->setOrder(["com_dvi_sed_numero"=>"asc", "com_anio" => "asc", "com_semestre" => "asc", "com_dvi_numero" => "asc", "per_apellidos" => "asc", "per_nombres" => "asc"]);
    $sql = EntitySqlo::getInstanceString("nomina2")->activos($fecha, $render);
    $rows = Dba::fetchAll($sql);
    return EntitySql::getInstanceString("nomina2")->jsonAll($rows);
  }

  public static function nominaNoActivos($fecha){
    $render = new Render();
    $render->setOrder(["com_dvi_sed_numero"=>"asc", "com_anio" => "asc", "com_semestre" => "asc", "per_apellidos" => "asc", "per_nombres" => "asc"]);
    $sql = EntitySqlo::getInstanceString("nomina2")->noActivos($fecha, $render);
    $rows = Dba::fetchAll($sql);
    return EntitySql::getInstanceString("nomina2")->jsonAll($rows);
  }

  public static function nominaActivosDuplicados($fecha){
    $render = new Render();
    $render->setOrder(["com_dvi_sed_numero"=>"asc", "com_anio" => "asc", "com_semestre" => "asc", "com_dvi_numero" => "asc", "per_apellidos" => "asc", "per_nombres" => "asc"]);
    $sql = EntitySqlo::getInstanceString("nomina2")->activosDuplicados($fecha);
    $rows = Dba::fetchAll($sql);
    return EntitySql::getInstanceString("nomina2")->jsonAll($rows);
  }

  public static function consolidado($fecha){
    $tomaSql = EntitySql::getInstanceString('toma', 'toma');
    $profesorSql = EntitySql::getInstanceString('id_persona', 'pro');
    $reemplazoSql = EntitySql::getInstanceString('id_persona', 'ree');

    $sqlCursos = EntitySqlo::getInstanceString("curso")->all([
    	["com_fecha", "=", $fecha],
    	["com_publicar", "=", true]
    ]);

    $sql = "
SELECT curso.*,
" . $tomaSql->fields() . ",
" . $profesorSql->fields() . ",
" . $reemplazoSql->fields() . "
FROM (

$sqlCursos

) AS curso
LEFT JOIN toma AS toma ON (toma.curso = curso.id)
" . $profesorSql->_join('profesor', 'toma') . "
" . $reemplazoSql->_join('reemplaza', 'toma') . "
" . $tomaSql->_joinAux() . "
" . $profesorSql->_joinAux() . "
" . $reemplazoSql->_joinAux() . "

ORDER BY com_dvi_sed_numero, com_dvi_numero, com_anio, com_semestre, ch_asi_nombre;
";
    $rows = Dba::fetchAll($sql);
    $idComision = null;
    $idCurso = null;
    $comisiones = [];
    $i = -1;

    $sql = EntitySqlo::getInstanceString("comision")->cantidadAlumnosActivos($fecha);


    $cantidadActivos = Dba::fetchAll($sql);

    foreach($rows as $row){
      if($row["id"] != $idCurso) {
        if($row["com_id"] != $idComision) {
          $idComision = $row["com_id"];

          $i++;
          $j = -1;
          $comisiones[$i] = EntitySql::getInstanceString("comision", "com")->_json($row);
          $comisiones[$i]["division_"] =  EntitySql::getInstanceString("division", "com_dvi")->_json($row);
          $comisiones[$i]["division_"]["sede_"] =  EntitySql::getInstanceString("sede", "com_dvi_sed")->_json($row);
          $comisiones[$i]["division_"]["sede_"]["domicilio_"] =  EntitySql::getInstanceString("domicilio", "com_dvi_sed_dom")->_json($row);
          $comisiones[$i]["division_"]["sede_"]["coordinador_"] =  EntitySql::getInstanceString("id_persona", "com_dvi_sed_coo")->_json($row);
          $comisiones[$i]["division_"]["plan_"] =  EntitySql::getInstanceString("plan", "com_dvi_pla")->_json($row);

          $coordinador = EntitySql::getInstanceString("id_persona", "com_dvi_sed_coo")->_json($row);
          if(!empty($coordinador)) $comisiones[$i]["division_"]["sede_"]["coordinador_"] = $coordinador;
          $comisiones[$i]["cursos"] = [];
          $comisiones[$i]["cantidad_activos"] = 0;
          foreach($cantidadActivos as $cantidad){
            if($idComision == $cantidad["comision"]) $comisiones[$i]["cantidad_activos"] = $cantidad["cantidad"];
          }
        }

        $idCurso = $row["id"];
        $j++;
        $comisiones[$i]["cursos"][$j] = EntitySql::getInstanceString("curso")->_json($row);
        $comisiones[$i]["cursos"][$j]["carga_horaria_"] = EntitySql::getInstanceString("carga_horaria", "ch")->_json($row);
        $comisiones[$i]["cursos"][$j]["carga_horaria_"]["asignatura_"] = EntitySql::getInstanceString("asignatura", "ch_asi")->_json($row);
        $comisiones[$i]["cursos"][$j]["tomas"] = [];
      }

      $toma = $tomaSql->json($row);

      $profesor = $profesorSql->json($row);
      if(!empty($profesor)) $toma["profesor_"] = $profesorSql->json($row);

      $reemplazo = $reemplazoSql->json($row);
      if(!empty($reemplazo)) $toma["reemplazo_"] = $reemplazoSql->json($row);

      if(!empty($toma)) array_push($comisiones[$i]["cursos"][$j]["tomas"], $toma);
    }



    return $comisiones;
  }





  public function buscarAlumnos($search) {
    $render = new Render();
    $render->setSearch($search);
    return Dba::all("nomina2", $render);
  }




    public function cantidadAlumnos($fecha){
      $sqlF = EntitySqlo::getInstanceString("nomina2")->cantidadActivosPorSexo($fecha, "Femenino");
      $sqlM = EntitySqlo::getInstanceString("nomina2")->cantidadActivosPorSexo($fecha, "Masculino");

     $sql = "
  SELECT mujeres.anio, mujeres.semestre, mujeres.cantidad AS cantidad_mujeres, hombres.cantidad AS cantidad_hombres
  FROM (
    {$sqlF}
  ) AS mujeres
  JOIN (
    {$sqlM}
  ) AS hombres
  ON (mujeres.anio = hombres.anio AND mujeres.semestre = hombres.semestre);
  ";

        return Dba::fetchAll($sql);
    }





      public static function cantidadHorasDocente($fecha, $optCoord){

        $sql = "
    SELECT
    id_persona.apellidos, id_persona.nombres, id_persona.cuil,
    DATE_FORMAT(id_persona.fecha_nacimiento,'%d/%m/%Y') AS fecha_nacimiento,
    SUM(carga_horaria.horas_catedra) AS horas_catedra
    FROM toma
    INNER JOIN curso ON (toma.curso = curso.id)
    INNER JOIN comision ON (comision.id = curso.comision)
    INNER JOIN division ON (comision.division = division.id)
    INNER JOIN sede ON (division.sede = sede.id)
    INNER JOIN carga_horaria ON (curso.carga_horaria = carga_horaria.id)
    INNER JOIN asignatura ON (carga_horaria.asignatura = asignatura.id)
    INNER JOIN id_persona ON (toma.profesor = id_persona.id)
    LEFT JOIN (
       SELECT id_persona.id, SUM( carga_horaria.horas_catedra ) AS horas_catedra
       FROM toma
       RIGHT JOIN curso ON ( curso.id = toma.curso )
       INNER JOIN comision ON ( curso.comision = comision.id )
       INNER JOIN division ON ( comision.division = division.id )
       INNER JOIN sede ON ( division.sede = sede.id )
       INNER JOIN carga_horaria ON ( curso.carga_horaria = carga_horaria.id )
       INNER JOIN id_persona ON ( toma.profesor = id_persona.id )
       WHERE toma.estado = 'Aprobada'
       AND comision.fecha = '" . $fecha . "'
       GROUP BY id_persona.id
    ) AS toma_cargada ON toma_cargada.id = id_persona.id
    WHERE toma.profesor IS NOT NULL
    AND toma.estado = 'Aprobada'
    AND carga_horaria.plan " . $optCoord . " 3 /* = 3 para coordinadores */
    AND comision.fecha = '" . $fecha . "'
    GROUP BY apellidos, nombres, cuil, fecha_nacimiento
    ORDER BY horas_catedra DESC, apellidos, nombres
    ";

        return Dba::fetchAll($sql);

      }









  public function sedes(){
    $sql = "
SELECT DISTINCT sede.id AS id_sede, sede.numero AS numero_sede, sede.nombre,
domicilio.calle, domicilio.entre, domicilio.numero AS numero_domicilio, domicilio.barrio, domicilio.localidad,
id_persona.apellidos, id_persona.nombres, id_persona.tipo_documento, id_persona.email, id_persona.numero_documento, telefono,
coordinador_persona.nombres AS coordinador_nombres
FROM id_persona
LEFT JOIN (
  SELECT DISTINCT id_persona.id AS persona, GROUP_CONCAT(DISTINCT telefono.prefijo, \" \", telefono.numero, \" (\", telefono.tipo, \")\"
  SEPARATOR ', ' ) AS telefono
  FROM id_persona
  INNER JOIN telefono ON (telefono.persona = id_persona.id)
  GROUP BY persona
) AS telefono ON ( id_persona.id = telefono.persona )
INNER JOIN referente ON (referente.persona = id_persona.id)
INNER JOIN sede ON (sede.id = referente.sede)
LEFT JOIN domicilio ON ( sede.domicilio = domicilio.id )
LEFT JOIN coordinador ON ( coordinador.sede = sede.id )
LEFT JOIN id_persona AS coordinador_persona ON (coordinador_persona.id = coordinador.persona)
WHERE sede.numero IS NOT NULL
AND coordinador.baja IS NULL
ORDER BY sede.numero,id_persona.nombres, id_persona.apellidos;
";

    return Dba::fetchAll($sql);
  }

  /* DEPRECATED
  public function sedesActivas($fecha){
    $sql = "
SELECT DISTINCT sede.id AS id_sede, sede.numero AS numero_sede, sede.nombre,
domicilio.calle, domicilio.entre, domicilio.numero AS numero_domicilio, domicilio.barrio, domicilio.localidad,
id_persona.apellidos, id_persona.nombres, id_persona.tipo_documento, id_persona.email, id_persona.numero_documento, telefono,
coordinador_persona.nombres AS coordinador_nombres
FROM id_persona
LEFT JOIN (
  SELECT DISTINCT id_persona.id AS persona, GROUP_CONCAT(DISTINCT telefono.prefijo, \" \", telefono.numero, \" (\", telefono.tipo, \")\"
  SEPARATOR ', ' ) AS telefono
  FROM id_persona
  INNER JOIN telefono ON (telefono.persona = id_persona.id)
  GROUP BY persona
) AS telefono ON ( id_persona.id = telefono.persona )
INNER JOIN referente ON (referente.persona = id_persona.id)
INNER JOIN sede ON (sede.id = referente.sede)
INNER JOIN division ON (sede.id = division.sede)
INNER JOIN comision ON (comision.division = division.id)
LEFT JOIN domicilio ON (sede.domicilio = domicilio.id )
LEFT JOIN coordinador ON ( coordinador.sede = sede.id )
LEFT JOIN id_persona AS coordinador_persona ON (coordinador_persona.id = coordinador.persona)
WHERE sede.numero IS NOT NULL
AND comision.fecha = '{$fecha}'
ORDER BY sede.numero,id_persona.nombres, id_persona.apellidos;
";

    return Dba::fetchAll($sql);
  }*/



  public function emailsReferentes($fecha){
    //1533576121105506 ex 65, 1561789468007604 ex 77
    $sql = "
SELECT DISTINCT id_persona.email
FROM id_persona
INNER JOIN referente ON (referente.persona = id_persona.id)
INNER JOIN sede ON (referente.sede = sede.id)
INNER JOIN division ON (division.sede = sede.id)
INNER JOIN comision ON (comision.division = division.id)
WHERE comision.fecha = '{$fecha}'
AND (comision.autorizada OR comision.publicar)
AND id_persona.email IS NOT NULL;
";

    return Dba::fetchAll($sql);
  }


  public function nominaDea($fecha){
      $sql = "
     SELECT DISTINCT id_persona.nombres, id_persona.apellidos, id_persona.cuil, DATE_FORMAT(id_persona.fecha_nacimiento,'%d/%m/%Y') AS fecha_nacimiento, genero,
comision.anio, comision.semestre, division.numero AS numero_division, sede.numero, sede.nombre, domicilio.localidad,
nomina2.programa
FROM nomina2
INNER JOIN id_persona ON (nomina2.persona = id_persona.id)
INNER JOIN (
  SELECT persona, COUNT(*) as cantidad
  FROM nomina2
  INNER JOIN comision ON (nomina2.comision = comision.id)
  WHERE nomina2.activo
  AND comision.fecha = '{$fecha}'
  GROUP BY persona
  HAVING cantidad = 1
) AS sin_duplicados ON (id_persona.id = sin_duplicados.persona)
INNER JOIN comision ON (nomina2.comision = comision.id)
INNER JOIN division ON (comision.division = division.id)
INNER JOIN sede ON (division.sede = sede.id)
INNER JOIN domicilio ON (sede.domicilio = domicilio.id)
WHERE nomina2.activo
AND comision.fecha = '{$fecha}'
AND comision.autorizada = true
ORDER BY sede.numero, comision.anio, comision.semestre, id_persona.apellidos, id_persona.nombres;
";
    return Dba::fetchAll($sql);
  }




public function cantidadAlumnosPorComision($fecha){
   $sql = "
SELECT comision.id AS id_comision, sede.numero AS numero_sede, sede.nombre AS nombre_sede, division.numero AS numero_division, comision.anio AS anio_comision, comision.semestre AS semestre_comision, COUNT(DISTINCT nom.persona) AS cantidad
FROM comision
INNER JOIN division ON (comision.division = division.id)
INNER JOIN sede ON (division.sede = sede.id)
INNER JOIN plan ON ( division.plan = plan.id )
LEFT JOIN (
  SELECT comision, persona
  FROM nomina2
  LEFT JOIN id_persona ON ( nomina2.persona = id_persona.id )
  WHERE nomina2.activo
) AS nom ON (nom.comision = comision.id)
WHERE fecha = '{$fecha}'
AND comision.publicar
AND plan.id != 3
GROUP BY id_comision, numero_sede, nombre_sede, numero_division, anio_comision, semestre_comision
ORDER BY numero_sede;
";

      return Dba::fetchAll($sql);
  }





  public function comisiones($fecha, $orden = "sede", $sede = null) {

    $sqlOrden = ($orden == "sede") ?
      "sede.numero, comision.anio, comision.semestre":
      "comision.anio, comision.semestre, sede.numero";

    $sql = "
SELECT DISTINCT
sede.numero AS numero_sede, sede.nombre,
domicilio.calle, domicilio.entre, domicilio.numero AS numero_domicilio, domicilio.barrio, domicilio.localidad,
plan.orientacion,
division.numero AS numero_division,
comision.anio, comision.semestre, comision.autorizada, comision.comentario, comision.id AS id_comision,
id_persona.sobrenombre, id_persona.nombres,
comision.apertura
FROM comision
INNER JOIN division ON ( comision.division = division.id )
INNER JOIN sede ON ( division.sede = sede.id )
INNER JOIN plan ON ( division.plan = plan.id )
LEFT JOIN domicilio ON ( sede.domicilio = domicilio.id )
LEFT JOIN coordinador ON ( coordinador.sede = sede.id )
LEFT JOIN id_persona ON ( coordinador.persona = id_persona.id )
WHERE comision.fecha =  '" . $fecha . "'
";

    if($sede) $sql .= "AND sede.id = {$sede}
";

    $sql .= "AND plan.id !=3
AND publicar
AND coordinador.baja IS NULL
ORDER BY " . $sqlOrden . ";
";


    return Dba::fetchAll($sql);
  }


  public function comisionesPorCoordinador($fecha) {
    $sql = "
SELECT id_persona.sobrenombre, id_persona.nombres, id_persona.id, cant.anio, cant.semestre, cant.cantidad
FROM id_persona
INNER JOIN
( SELECT DISTINCT
id_persona.id, comision.anio, comision.semestre, COUNT(comision.id) AS cantidad
FROM coordinador
LEFT JOIN sede ON ( coordinador.sede = sede.id )
INNER JOIN division ON ( sede.id = division.sede )
INNER JOIN comision ON ( division.id = comision.division )
INNER JOIN id_persona ON ( coordinador.persona = id_persona.id )
WHERE comision.fecha =  '{$fecha}'
AND (comision.autorizada OR comision.publicar)
AND coordinador.baja IS NULL
GROUP BY id_persona.id, comision.anio, comision.semestre
) AS cant
ON (id_persona.id = cant.id)
";

    return Dba::fetchAll($sql);
  }




  public function horarios($comisionId) {

    $sql = "
SELECT DISTINCT
  sede.numero AS numero_sede, sede.nombre,
  domicilio.calle, domicilio.entre, domicilio.numero AS numero_domicilio, domicilio.barrio, domicilio.localidad,
  plan.orientacion,
  carga_horaria.anio, carga_horaria.semestre, carga_horaria.horas_catedra, CONCAT(FLOOR((carga_horaria.horas_catedra*40)/60),':',LPAD(MOD((carga_horaria.horas_catedra*40),60),2,\"0\")) AS horas_reloj,
  division.numero AS numero_division,
  comision.autorizada, comision.comentario, comision.id, comision.anio, comision.semestre,
  asignatura.nombre AS nombre_asignatura,
  dia.numero,
  dia.dia,
  profesor.nombres, profesor.numero_documento, profesor.estado, profesor.registrado,
  coord.nombres AS coordinador_nombres, coord.sobrenombre AS coordinador_sobrenombre,
  TIME_FORMAT(horario.hora_inicio, '%H:%i') AS hora_inicio,
  TIME_FORMAT(horario.hora_fin, '%H:%i') AS hora_fin
FROM curso
INNER JOIN comision ON (comision.id = curso.comision)
INNER JOIN horario ON (horario.curso = curso.id)
INNER JOIN division ON (division.id = comision.division)
INNER JOIN sede ON (sede.id = division.sede)
INNER JOIN domicilio ON (sede.domicilio = domicilio.id)
INNER JOIN plan ON (division.plan = plan.id)
INNER JOIN carga_horaria ON (carga_horaria.id = curso.carga_horaria)
INNER JOIN asignatura ON (asignatura.id = carga_horaria.asignatura)
LEFT JOIN dia ON (dia.id = horario.dia)
LEFT JOIN (
    SELECT
      curso.id AS curso,
      id_persona.nombres, id_persona.apellidos, id_persona.numero_documento,
      IF(usuario.id IS NULL,'No Registrado', 'Registrado') AS registrado,
      toma.estado
    FROM curso
    INNER JOIN comision ON (curso.comision = comision.id)
    INNER JOIN toma ON (curso.id = toma.curso)
    INNER JOIN id_persona ON (toma.profesor = id_persona.id)
    LEFT JOIN usuario ON (id_persona.id = usuario.persona)
    WHERE comision.id = '" . $comisionId . "'
    AND (toma.estado = 'Aprobada' OR toma.estado = 'Pendiente')
    AND toma.estado_contralor != 'Modificar'
) AS profesor ON (profesor.curso = curso.id)
LEFT JOIN coordinador ON ( coordinador.sede = sede.id )
LEFT JOIN id_persona AS coord ON ( coordinador.persona = coord.id )
WHERE comision.id = '" . $comisionId . "'
AND coordinador.baja IS NULL
ORDER BY dia.numero, hora_inicio;
";

    return Dba::fetchAll($sql);
  }





  public function actaResumen($fecha, $optCoord){

    $sql = "
SET lc_time_names = 'es_AR';

SELECT id_persona.apellidos, id_persona.nombres, id_persona.numero_documento,
DATE_FORMAT(id_persona.fecha_nacimiento,'%d/%m/%Y') AS fecha_nacimiento,
DATE_FORMAT(toma.fecha_toma,'%d/%m/%Y') AS fecha_toma,
DATE_FORMAT(toma.fecha_fin,'%d/%m/%Y') AS fecha_fin, SUM(carga_horaria.horas_catedra) AS horas_catedra

FROM toma
INNER JOIN curso ON (toma.curso = curso.id)
INNER JOIN comision ON (comision.id = curso.comision)
INNER JOIN division ON (comision.division = division.id)
INNER JOIN sede ON (division.sede = sede.id)
INNER JOIN carga_horaria ON (curso.carga_horaria = carga_horaria.id)
INNER JOIN asignatura ON (carga_horaria.asignatura = asignatura.id)
INNER JOIN id_persona ON (toma.profesor = id_persona.id)

WHERE toma.profesor IS NOT NULL
AND ((toma.estado = 'Aprobada') OR (toma.estado = 'Renuncia') OR (toma.estado = 'Baja'))
AND (toma.estado_contralor = 'Pasar' OR toma.estado_contralor = 'Modificar')
AND comision.fecha = '" . $fecha . "'
AND toma.fecha_entrada_contralor IS NOT NULL
GROUP BY apellidos, nombres, numero_documento, fecha_nacimiento, fecha_toma, fecha_fin
ORDER BY CAST(numero_documento AS UNSIGNED), fecha_toma;
";


    $db = Dba::dbInstance();
    try {
      $result = $db->multiQuery($sql);
      try { return $db->fetchAll($result); }
      finally { $result->close(); }
    }
    finally { Dba::dbClose(); }

  }







  public function actoPublico($fecha){
    $sql = "
SELECT DISTINCT
curso.id AS id_curso,
asignatura.nombre AS asignatura,
asignatura.codigo, asignatura.perfil,
sede.numero AS numero_sede, sede.nombre,
carga_horaria.horas_catedra,
domicilio.calle, domicilio.entre, domicilio.numero AS numero_domicilio, domicilio.barrio, domicilio.localidad,
division.serie, comision.anio, comision.semestre,
horario.horario
FROM curso
INNER JOIN carga_horaria ON (curso.carga_horaria = carga_horaria.id)
INNER JOIN asignatura ON (carga_horaria.asignatura = asignatura.id)
INNER JOIN comision ON (comision.id = curso.comision)
INNER JOIN division ON ( comision.division = division.id )
INNER JOIN sede ON ( division.sede = sede.id )
INNER JOIN plan ON ( division.plan = plan.id )
LEFT JOIN domicilio ON ( sede.domicilio = domicilio.id )
LEFT JOIN (
  SELECT curso.id AS id_curso, GROUP_CONCAT(dia.dia, \" \", TIME_FORMAT(horario.hora_inicio, '%H:%i'), \" a \", TIME_FORMAT(horario.hora_fin, '%H:%i')) AS horario
  FROM curso
  INNER JOIN horario ON (horario.curso = curso.id)
  INNER JOIN dia ON (dia.id = horario.dia)
  INNER JOIN comision ON (comision.id = curso.comision)
  INNER JOIN division ON ( comision.division = division.id )
  INNER JOIN plan ON ( division.plan = plan.id )
  WHERE comision.fecha =  '{$fecha}'
  AND comision.autorizada
  AND comision.publicar
  AND plan.id !=3
  GROUP BY curso.id
) AS horario ON (horario.id_curso = curso.id)
LEFT JOIN (
    SELECT
      curso.id AS curso,
      id_persona.nombres, id_persona.apellidos, id_persona.numero_documento,
      IF(usuario.id IS NULL,'No Registrado', 'Registrado') AS registrado,
      toma.estado
    FROM curso
    INNER JOIN comision ON (curso.comision = comision.id)
    INNER JOIN toma ON (curso.id = toma.curso)
    INNER JOIN id_persona ON (toma.profesor = id_persona.id)
    LEFT JOIN usuario ON (id_persona.id = usuario.persona)
    AND toma.estado = 'Aprobada' OR toma.estado = 'Pendiente'
) AS profesor ON (profesor.curso = curso.id)
WHERE comision.fecha =  '{$fecha}'
AND comision.autorizada
AND comision.publicar
AND plan.id !=3
ORDER BY asignatura.nombre, sede.numero, comision.anio, comision.semestre;
";

    return Dba::fetchAll($sql);
  }



  public function actoPublicoSinCubrir($fecha){
    $sql = "
SELECT DISTINCT
curso.id AS id_curso,
asignatura.nombre AS asignatura,
asignatura.codigo, asignatura.perfil,
sede.numero AS numero_sede, sede.nombre,
carga_horaria.horas_catedra,
domicilio.calle, domicilio.entre, domicilio.numero AS numero_domicilio, domicilio.barrio, domicilio.localidad,
division.serie, comision.anio, comision.semestre,
horario.horario
FROM curso
INNER JOIN carga_horaria ON (curso.carga_horaria = carga_horaria.id)
INNER JOIN asignatura ON (carga_horaria.asignatura = asignatura.id)
INNER JOIN comision ON (comision.id = curso.comision)
INNER JOIN division ON ( comision.division = division.id )
INNER JOIN sede ON ( division.sede = sede.id )
INNER JOIN plan ON ( division.plan = plan.id )
LEFT JOIN domicilio ON ( sede.domicilio = domicilio.id )
LEFT JOIN (
  SELECT curso.id AS id_curso, GROUP_CONCAT(dia.dia, \" \", TIME_FORMAT(horario.hora_inicio, '%H:%i'), \" a \", TIME_FORMAT(horario.hora_fin, '%H:%i')) AS horario
  FROM curso
  INNER JOIN horario ON (horario.curso = curso.id)
  INNER JOIN dia ON (dia.id = horario.dia)
  INNER JOIN comision ON (comision.id = curso.comision)
  INNER JOIN division ON ( comision.division = division.id )
  INNER JOIN plan ON ( division.plan = plan.id )
  WHERE comision.fecha =  '{$fecha}'
  AND comision.autorizada
  AND comision.publicar
  AND plan.id !=3
  GROUP BY curso.id
) AS horario ON (horario.id_curso = curso.id)
LEFT JOIN (
    SELECT
      curso.id AS curso,
      id_persona.nombres, id_persona.apellidos, id_persona.numero_documento,
      IF(usuario.id IS NULL,'No Registrado', 'Registrado') AS registrado,
      toma.estado
    FROM curso
    INNER JOIN comision ON (curso.comision = comision.id)
    INNER JOIN toma ON (curso.id = toma.curso)
    INNER JOIN id_persona ON (toma.profesor = id_persona.id)
    LEFT JOIN usuario ON (id_persona.id = usuario.persona)
    AND toma.estado = 'Aprobada' OR toma.estado = 'Pendiente'
) AS profesor ON (profesor.curso = curso.id)
WHERE comision.fecha =  '{$fecha}'
AND comision.autorizada
AND comision.publicar
AND plan.id !=3
ORDER BY asignatura.nombre, sede.numero, comision.anio, comision.semestre;
";

    return Dba::fetchAll($sql);
  }


  


  function sedesActoPublico($fecha){
    $sql = "
  SELECT DISTINCT
  sede.numero AS numero_sede, sede.nombre,
  domicilio.calle, domicilio.entre, domicilio.numero AS numero_domicilio, domicilio.barrio, domicilio.localidad,
  referente.referentes
  FROM comision
  INNER JOIN division ON ( comision.division = division.id )
  INNER JOIN sede ON ( division.sede = sede.id )
  LEFT JOIN domicilio ON ( sede.domicilio = domicilio.id )
  LEFT JOIN (
    SELECT DISTINCT sede.id AS sede, sede.nombre, GROUP_CONCAT(DISTINCT lower(id_persona.nombres), \" \", lower(id_persona.apellidos)) AS referentes
    FROM sede
    INNER JOIN referente ON (sede.id = referente.sede)
    INNER JOIN id_persona ON (referente.persona = id_persona.id)
    INNER JOIN division ON (sede.id = division.sede)
    INNER JOIN comision ON (division.id = comision.division)
    WHERE comision.fecha = '{$fecha}'
    AND comision.autorizada
    AND comision.publicar
    GROUP BY sede.id, sede.nombre
  ) AS referente ON (referente.sede = sede.id)
  WHERE comision.fecha =  '{$fecha}'
  AND comision.autorizada
  AND comision.publicar
  ORDER BY sede.numero;
";

    return Dba::fetchAll($sql);
  }


  function controlNotas($fecha) {
    $sql = "
      SELECT
        sede.numero AS numero_sede,
        sede.nombre AS sede,
        domicilio.calle,
        domicilio.numero AS numero_domicilio,
        domicilio.entre,
        domicilio.barrio,
        domicilio.localidad,
        carga_horaria.anio,
        carga_horaria.semestre,
        division.numero AS numero_division,
        asignatura.nombre AS asignatura,
        id_persona.apellidos,
        id_persona.nombres,
        id_persona.fecha_nacimiento,
        REPLACE(FORMAT(id_persona.numero_documento,0), ',', '.') AS numero_documento,
        id_persona.cuil,
        toma.observaciones,
        toma.fecha_toma,
        toma.fecha_inicio,
        toma.fecha_fin,
        toma.fecha_entrada_contralor,
        toma.estado,
        toma.estado_contralor,
        plan.orientacion,
        horario.horario,
        coordinador_persona.nombres AS coordinador_nombres,
        coordinador_persona.sobrenombre AS coordinador_sobrenombre
      FROM toma
      RIGHT JOIN curso ON (curso.id = toma.curso)
      INNER JOIN comision ON (curso.comision = comision.id)
      INNER JOIN division ON (comision.division = division.id)
      INNER JOIN plan ON (division.plan = plan.id)
      INNER JOIN sede ON (division.sede = sede.id)
      LEFT JOIN domicilio ON (domicilio.id = sede.domicilio)
      INNER JOIN carga_horaria ON (curso.carga_horaria = carga_horaria.id)
      INNER JOIN asignatura ON (carga_horaria.asignatura = asignatura.id)
      LEFT JOIN id_persona ON (toma.profesor = id_persona.id)
      LEFT JOIN coordinador ON ( coordinador.sede = sede.id )
      LEFT JOIN id_persona AS coordinador_persona ON ( coordinador.persona = coordinador_persona.id )
      LEFT JOIN (
        SELECT curso.id AS id_curso, GROUP_CONCAT(dia.dia, \" \", TIME_FORMAT(horario.hora_inicio, '%H:%i'), \" a \", TIME_FORMAT(horario.hora_fin, '%H:%i')) AS horario
        FROM curso
        INNER JOIN horario ON (horario.curso = curso.id)
        INNER JOIN dia ON (dia.id = horario.dia)
        INNER JOIN comision ON (comision.id = curso.comision)
        INNER JOIN division ON ( comision.division = division.id )
        INNER JOIN plan ON ( division.plan = plan.id )
        WHERE comision.fecha =  '{$fecha}'
        AND comision.autorizada
        AND comision.publicar

        GROUP BY curso.id
      ) AS horario ON (horario.id_curso = curso.id)
      WHERE fecha = '{$fecha}'
      AND (toma.estado = 'Pendiente' OR toma.estado = 'Aprobada')
      AND (toma.estado_contralor != 'Modificar')
      AND comision.autorizada
      AND plan.id != 3
      ORDER BY sede.numero, division.numero, comision.anio, comision.semestre

      LIMIT 0,3000;
";

    return Dba::fetchAllTimeAr($sql);
  }


  function controlNotas2($fecha) {
    $sql = "
      SELECT
        sede.numero AS numero_sede,
        sede.nombre AS sede,
        domicilio.calle,
        domicilio.numero AS numero_domicilio,
        domicilio.entre,
        domicilio.barrio,
        domicilio.localidad,
        carga_horaria.anio,
        carga_horaria.semestre,
        division.numero AS numero_division,
        asignatura.nombre AS asignatura,
        id_persona.apellidos,
        id_persona.nombres,
        id_persona.fecha_nacimiento,
        REPLACE(FORMAT(id_persona.numero_documento,0), ',', '.') AS numero_documento,
        id_persona.cuil,
        toma.observaciones,
        toma.fecha_toma,
        toma.fecha_inicio,
        toma.fecha_fin,
        toma.fecha_entrada_contralor,
        toma.estado,
        toma.estado_contralor,
        plan.orientacion,
        horario.horario,
        coordinador_persona.nombres AS coordinador_nombres,
        coordinador_persona.sobrenombre AS coordinador_sobrenombre
      FROM toma
      RIGHT JOIN curso ON (curso.id = toma.curso)
      INNER JOIN comision ON (curso.comision = comision.id)
      INNER JOIN division ON (comision.division = division.id)
      INNER JOIN plan ON (division.plan = plan.id)
      INNER JOIN sede ON (division.sede = sede.id)
      LEFT JOIN domicilio ON (domicilio.id = sede.domicilio)
      INNER JOIN carga_horaria ON (curso.carga_horaria = carga_horaria.id)
      INNER JOIN asignatura ON (carga_horaria.asignatura = asignatura.id)
      LEFT JOIN id_persona ON (toma.profesor = id_persona.id)
      LEFT JOIN coordinador ON ( coordinador.sede = sede.id )
      LEFT JOIN id_persona AS coordinador_persona ON ( coordinador.persona = coordinador_persona.id )
      LEFT JOIN (
        SELECT curso.id AS id_curso, GROUP_CONCAT(dia.dia, \" \", TIME_FORMAT(horario.hora_inicio, '%H:%i'), \" a \", TIME_FORMAT(horario.hora_fin, '%H:%i')) AS horario
        FROM curso
        INNER JOIN horario ON (horario.curso = curso.id)
        INNER JOIN dia ON (dia.id = horario.dia)
        INNER JOIN comision ON (comision.id = curso.comision)
        INNER JOIN division ON ( comision.division = division.id )
        INNER JOIN plan ON ( division.plan = plan.id )
        WHERE comision.fecha =  '{$fecha}'
        AND comision.autorizada
        AND comision.publicar

        GROUP BY curso.id
      ) AS horario ON (horario.id_curso = curso.id)
      WHERE fecha = '{$fecha}'
      AND (toma.estado = 'Pendiente' OR toma.estado = 'Aprobada')
      AND (toma.estado_contralor != 'Modificar')
      AND comision.autorizada
      AND plan.id != 3
      ORDER BY sede.numero, division.numero, comision.anio, comision.semestre

      LIMIT 0,3000;
  ";

    return Dba::fetchAllTimeAr($sql);
  }


  public static function tomasAgrupadasPorSemestre($profesor) {
    $render = new Render();
    $render->addAdvanced(["profesor", "=", $profesor]);
    $render->setOrder(["cur_com_fecha" => "DESC"]);
    $tomas = Dba::all("toma", $render);
    $tomas_ = [];

    foreach($tomas as $toma){
      $fecha = DateTime::createFromFormat("Y-m-d", $toma["curso_"]["comision_"]["fecha"]);

      $anio = $fecha->format("Y");
      $semestre = intval($fecha->format("m"));
      $periodo = ($semestre <= 6) ? "{$anio}-1" : "{$anio}-2";
      if (!array_key_exists($periodo, $tomas_)) $tomas_[$periodo] = [];
      array_push($tomas_[$periodo], $toma);
    }

    return $tomas_;
  }


  public static function nominasAgrupadasPorSemestre($alumno) {
    $render = new Render();
    $render->addAdvanced(["persona", "=", $alumno]);
    $render->setOrder(["com_fecha" => "DESC"]);
    $nominas = Dba::all("nomina2", $render);
    $nominas_ = [];

    foreach($nominas as $nomina){
      $fecha = DateTime::createFromFormat("Y-m-d", $nomina["comision_"]["fecha"]);

      $anio = $fecha->format("Y");
      $semestre = intval($fecha->format("m"));
      $periodo = ($semestre <= 6) ? "{$anio}-1" : "{$anio}-2";
      if (!array_key_exists($periodo, $nominas_)) $nominas_[$periodo] = [];
      array_push($nominas_[$periodo], $nomina);
    }

    return $nominas_;
  }




  protected static function fromContralor($fecha, $optCoord = '!=', $optFechaEntrada = "", array $idsPersona = NULL) {
    $sql = "
FROM toma
INNER JOIN curso ON (toma.curso = curso.id)
INNER JOIN comision ON (comision.id = curso.comision)
INNER JOIN division ON (comision.division = division.id)
INNER JOIN sede ON (division.sede = sede.id)
INNER JOIN carga_horaria ON (curso.carga_horaria = carga_horaria.id)
INNER JOIN asignatura ON (carga_horaria.asignatura = asignatura.id)
INNER JOIN id_persona ON (toma.profesor = id_persona.id)
LEFT JOIN id_persona AS reemplazo ON (toma.reemplaza = reemplazo.id)
WHERE toma.profesor IS NOT NULL
AND ((toma.estado = 'Aprobada') OR (toma.estado = 'Renuncia') OR (toma.estado = 'Baja'))
AND toma.estado_contralor = 'Pasar'
AND toma.fecha_entrada_contralor IS {$optFechaEntrada} NULL
AND carga_horaria.plan {$optCoord} 3 /* = 3 para coordinadores */
AND comision.fecha = '{$fecha}'
AND sede.numero <> '80'
";
    if(!empty($idsPersona)) $sql .= "AND id_persona.id IN (" . implode(',', $idsPersona) . ")";
    return $sql;
  }


  public static function contralorCantidad($fecha, $optCoord){
    $sql = "
SELECT count(*) AS cantidad
{self::fromContralor($fecha, $optCoord)}
";
    return Dba::fetchAll($sql);

  }


  public static function controlAlumnosTomas(){
    return "
SELECT toma.id, id_persona.numero_documento
FROM toma INNER JOIN curso ON (toma.curso = curso.id)
INNER JOIN nomina2 ON (toma.profesor = nomina2.persona)
INNER JOIN id_persona ON (id_persona.id = nomina2.persona)
";
  }


  
  public static function contralorPeriodo($fechaAnio, $fechaSemestre, $clasificacion){
    return "
SELECT profesor, IF(fecha_inicio > fecha_toma, fecha_inicio, fecha_toma) AS fecha_desde, fecha_fin, toma.estado, SUM(carga_horaria.horas_catedra) AS horas_catedra
FROM toma
INNER JOIN curso ON (toma.curso = curso.id) 
INNER JOIN comision ON (comision.id = curso.comision) 
INNER JOIN carga_horaria ON (curso.carga_horaria = carga_horaria.id)
INNER JOIN plan ON (carga_horaria.plan = plan.id)
INNER JOIN clasificacion_plan ON (clasificacion_plan.plan = plan.id) 
INNER JOIN clasificacion ON (clasificacion_plan.clasificacion = clasificacion.id)
INNER JOIN id_persona ON (toma.profesor = id_persona.id) 
WHERE toma.profesor IS NOT NULL
AND ((toma.estado = 'Aprobada')
OR (toma.estado = 'Renuncia')
OR (toma.estado = 'Baja'))
AND toma.fecha_entrada_contralor IS NULL 
AND toma.estado_contralor = 'Pasar' 
AND comision.fecha_anio = '{$fechaAnio}'
AND comision.fecha_semestre = {$fechaSemestre}
AND clasificacion.nombre = '$clasificacion'
GROUP BY profesor, fecha_desde, fecha_fin, toma.estado
ORDER BY CAST(id_persona.numero_documento AS UNSIGNED), fecha_desde;
";

  }

  public static function contralorIdsPeriodo($fechaAnio, $fechaSemestre, $clasificacion){
    return "
SELECT toma.id
FROM toma
INNER JOIN curso ON (toma.curso = curso.id) 
INNER JOIN comision ON (comision.id = curso.comision) 
INNER JOIN carga_horaria ON (curso.carga_horaria = carga_horaria.id)
INNER JOIN plan ON (carga_horaria.plan = plan.id)
INNER JOIN clasificacion_plan ON (clasificacion_plan.plan = plan.id) 
INNER JOIN clasificacion ON (clasificacion_plan.clasificacion = clasificacion.id)
WHERE toma.profesor IS NOT NULL
AND ((toma.estado = 'Aprobada')
OR (toma.estado = 'Renuncia')
OR (toma.estado = 'Baja'))
AND toma.fecha_entrada_contralor IS NULL 
AND toma.estado_contralor = 'Pasar' 
AND comision.fecha_anio = '{$fechaAnio}'
AND comision.fecha_semestre = {$fechaSemestre}
AND clasificacion.nombre = '$clasificacion'
";

  }


  public static function contralorAux($fecha, array $plan){
    $planes = implode(",", $plan);

    return "
SELECT id_persona.id AS persona,
IF(id_persona.cuil IS NOT NULL,
SUBSTRING(id_persona.cuil,1,2), '') AS cuil_inicio,
IF(id_persona.cuil IS NOT NULL,
SUBSTRING(id_persona.cuil,3,8), id_persona.numero_documento) AS cuil_numero,
IF(id_persona.cuil IS NOT NULL, SUBSTRING(id_persona.cuil,11,1), '') AS cuil_digito_verificador,
DATE_FORMAT(id_persona.fecha_nacimiento,'%d/%m/%Y') AS fecha_nacimiento,
CONCAT_WS(', ',id_persona.apellidos, id_persona.nombres) AS nombre,
asignatura.nombre AS asignatura,
carga_horaria.horas_catedra,
comision.anio,
comision.semestre,
division.turno,
toma.estado,
sede.numero AS numero_sede,
toma.fecha_toma,
toma.fecha_fin,
toma.fecha_entrada_contralor,
DATE_FORMAT(toma.fecha_fin,'%d') AS dia_hasta,
DATE_FORMAT(toma.fecha_fin,'%m') AS mes_hasta,
DATE_FORMAT(toma.fecha_fin,'%Y') AS anio_hasta,
toma.comentario_contralor,
reemplazo.numero_documento AS numero_documento_reemplazo

FROM toma
INNER JOIN curso ON (toma.curso = curso.id)
INNER JOIN comision ON (comision.id = curso.comision)
INNER JOIN division ON (comision.division = division.id)
INNER JOIN sede ON (division.sede = sede.id)
INNER JOIN carga_horaria ON (curso.carga_horaria = carga_horaria.id)
INNER JOIN asignatura ON (carga_horaria.asignatura = asignatura.id)
INNER JOIN id_persona ON (toma.profesor = id_persona.id)
LEFT JOIN id_persona AS reemplazo ON (toma.reemplaza = reemplazo.id)

WHERE toma.profesor IS NOT NULL
AND ((toma.estado = 'Aprobada')
OR (toma.estado = 'Renuncia')
OR (toma.estado = 'Baja'))
AND toma.estado_contralor = 'Pasar'
AND toma.fecha_entrada_contralor IS NULL AND carga_horaria.plan IN ({$planes})
AND comision.fecha = '{$fecha}'
ORDER BY CAST(id_persona.numero_documento AS UNSIGNED), fecha_toma, anio, semestre, numero_sede;
";
  }


  public static function contralorAuxIds($fecha, array $plan){
    $planes = implode(",", $plan);

    return "
SELECT DISTINCT toma.id
FROM toma
INNER JOIN curso ON (toma.curso = curso.id)
INNER JOIN comision ON (comision.id = curso.comision)
INNER JOIN division ON (comision.division = division.id)
INNER JOIN sede ON (division.sede = sede.id)
INNER JOIN carga_horaria ON (curso.carga_horaria = carga_horaria.id)
INNER JOIN asignatura ON (carga_horaria.asignatura = asignatura.id)
INNER JOIN id_persona ON (toma.profesor = id_persona.id)
LEFT JOIN id_persona AS reemplazo ON (toma.reemplaza = reemplazo.id)

WHERE toma.profesor IS NOT NULL
AND ((toma.estado = 'Aprobada')
OR (toma.estado = 'Renuncia')
OR (toma.estado = 'Baja'))
AND toma.estado_contralor = 'Pasar'
AND toma.fecha_entrada_contralor IS NULL AND carga_horaria.plan IN ({$planes})
AND comision.fecha = '{$fecha}'
";
  }

  public static function actaResumenAux($fecha) {
    return "
SELECT
id_persona.apellidos, id_persona.nombres, id_persona.cuil,
numero_documento,
DATE_FORMAT(id_persona.fecha_nacimiento,'%d/%m/%Y') AS fecha_nacimiento,
DATE_FORMAT(toma.fecha_toma,'%d/%m/%Y') AS fecha_toma,
DATE_FORMAT(toma.fecha_fin,'%d/%m/%Y') AS fecha_fin,
SUM(carga_horaria.horas_catedra) AS horas_catedra,
  sede.nombre AS nombre_sede

FROM toma
INNER JOIN curso ON (toma.curso = curso.id)
INNER JOIN comision ON (comision.id = curso.comision)
INNER JOIN division ON (comision.division = division.id)
INNER JOIN sede ON (division.sede = sede.id)
INNER JOIN carga_horaria ON (curso.carga_horaria = carga_horaria.id)
INNER JOIN asignatura ON (carga_horaria.asignatura = asignatura.id)
INNER JOIN id_persona ON (toma.profesor = id_persona.id)

WHERE toma.profesor IS NOT NULL
AND ((toma.estado = 'Aprobada') OR (toma.estado = 'Renuncia') OR (toma.estado = 'Baja'))
AND toma.estado_contralor = 'Pasar'
AND comision.fecha = '{$fecha}'
GROUP BY apellidos, nombres, numero_documento, fecha_nacimiento, nombre_sede, fecha_toma, fecha_fin
/* AND toma.fecha_entrada_contralor IS NOT NULL */
ORDER BY CAST(numero_documento AS UNSIGNED), fecha_toma, nombre_sede
";

  }

}
