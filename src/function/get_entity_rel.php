<?php

function get_entity_rel($entityName) {
  switch($entityName){
    case 'alumno': return [
  'doc' => ['field_id'=>'documento', 'field_name'=>'documento', 'entity_name'=>'file'],
  'pn' => ['field_id'=>'partida_nacimiento', 'field_name'=>'partida_nacimiento', 'entity_name'=>'file'],
  'ce' => ['field_id'=>'certificado_estudios', 'field_name'=>'certificado_estudios', 'entity_name'=>'file'],
  'cui' => ['field_id'=>'cuil', 'field_name'=>'cuil', 'entity_name'=>'file'],
  'per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona'],
  'per_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
    ];

    case 'alumno_comision': return [
  'per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona'],
  'per_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'com' => ['field_id'=>'comision', 'field_name'=>'comision', 'entity_name'=>'comision'],
  'com_sed' => ['field_id'=>'sede', 'field_name'=>'sede', 'entity_name'=>'sede'],
  'com_sed_dom' => ['field_id'=>'domicilio1', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'com_sed_ts' => ['field_id'=>'tipo_sede', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede'],
  'com_sed_ce' => ['field_id'=>'centro_educativo', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo'],
  'com_sed_ce_dom' => ['field_id'=>'domicilio2', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'com_moa' => ['field_id'=>'modalidad', 'field_name'=>'modalidad', 'entity_name'=>'modalidad'],
  'com_pla' => ['field_id'=>'planificacion', 'field_name'=>'planificacion', 'entity_name'=>'planificacion'],
  'com_pla_plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan'],
  'com_cal' => ['field_id'=>'calendario', 'field_name'=>'calendario', 'entity_name'=>'calendario'],
    ];

    case 'asignacion_planilla_docente': return [
  'pd' => ['field_id'=>'planilla_docente', 'field_name'=>'planilla_docente', 'entity_name'=>'planilla_docente'],
  'tom' => ['field_id'=>'toma', 'field_name'=>'toma', 'entity_name'=>'toma'],
  'tom_cur' => ['field_id'=>'curso', 'field_name'=>'curso', 'entity_name'=>'curso'],
  'tom_cur_com' => ['field_id'=>'comision', 'field_name'=>'comision', 'entity_name'=>'comision'],
  'tom_cur_com_sed' => ['field_id'=>'sede', 'field_name'=>'sede', 'entity_name'=>'sede'],
  'tom_cur_com_sed_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'tom_cur_com_sed_ts' => ['field_id'=>'tipo_sede', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede'],
  'tom_cur_com_sed_ce' => ['field_id'=>'centro_educativo', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo'],
  'tom_cur_com_sed_ce_dom' => ['field_id'=>'domicilio1', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'tom_cur_com_moa' => ['field_id'=>'modalidad', 'field_name'=>'modalidad', 'entity_name'=>'modalidad'],
  'tom_cur_com_pla' => ['field_id'=>'planificacion', 'field_name'=>'planificacion', 'entity_name'=>'planificacion'],
  'tom_cur_com_pla_plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan'],
  'tom_cur_com_cal' => ['field_id'=>'calendario', 'field_name'=>'calendario', 'entity_name'=>'calendario'],
  'tom_cur_asi' => ['field_id'=>'asignatura', 'field_name'=>'asignatura', 'entity_name'=>'asignatura'],
  'tom_doc' => ['field_id'=>'docente', 'field_name'=>'docente', 'entity_name'=>'persona'],
  'tom_doc_dom' => ['field_id'=>'domicilio2', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'tom_ree' => ['field_id'=>'reemplazo', 'field_name'=>'reemplazo', 'entity_name'=>'persona'],
  'tom_ree_dom' => ['field_id'=>'domicilio3', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'tom_pd' => ['field_id'=>'planilla_docente1', 'field_name'=>'planilla_docente', 'entity_name'=>'planilla_docente'],
    ];

    case 'calificacion': return [
  'cur' => ['field_id'=>'curso', 'field_name'=>'curso', 'entity_name'=>'curso'],
  'cur_com' => ['field_id'=>'comision', 'field_name'=>'comision', 'entity_name'=>'comision'],
  'cur_com_sed' => ['field_id'=>'sede', 'field_name'=>'sede', 'entity_name'=>'sede'],
  'cur_com_sed_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'cur_com_sed_ts' => ['field_id'=>'tipo_sede', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede'],
  'cur_com_sed_ce' => ['field_id'=>'centro_educativo', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo'],
  'cur_com_sed_ce_dom' => ['field_id'=>'domicilio1', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'cur_com_moa' => ['field_id'=>'modalidad', 'field_name'=>'modalidad', 'entity_name'=>'modalidad'],
  'cur_com_pla' => ['field_id'=>'planificacion', 'field_name'=>'planificacion', 'entity_name'=>'planificacion'],
  'cur_com_pla_plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan'],
  'cur_com_cal' => ['field_id'=>'calendario', 'field_name'=>'calendario', 'entity_name'=>'calendario'],
  'cur_asi' => ['field_id'=>'asignatura', 'field_name'=>'asignatura', 'entity_name'=>'asignatura'],
  'per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona'],
  'per_dom' => ['field_id'=>'domicilio2', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
    ];

    case 'centro_educativo': return [
  'dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
    ];

    case 'comision': return [
  'sed' => ['field_id'=>'sede', 'field_name'=>'sede', 'entity_name'=>'sede'],
  'sed_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'sed_ts' => ['field_id'=>'tipo_sede', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede'],
  'sed_ce' => ['field_id'=>'centro_educativo', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo'],
  'sed_ce_dom' => ['field_id'=>'domicilio1', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'moa' => ['field_id'=>'modalidad', 'field_name'=>'modalidad', 'entity_name'=>'modalidad'],
  'pla' => ['field_id'=>'planificacion', 'field_name'=>'planificacion', 'entity_name'=>'planificacion'],
  'pla_plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan'],
  'cal' => ['field_id'=>'calendario', 'field_name'=>'calendario', 'entity_name'=>'calendario'],
    ];

    case 'comision_relacionada': return [
  'com' => ['field_id'=>'comision', 'field_name'=>'comision', 'entity_name'=>'comision'],
  'com_sed' => ['field_id'=>'sede', 'field_name'=>'sede', 'entity_name'=>'sede'],
  'com_sed_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'com_sed_ts' => ['field_id'=>'tipo_sede', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede'],
  'com_sed_ce' => ['field_id'=>'centro_educativo', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo'],
  'com_sed_ce_dom' => ['field_id'=>'domicilio1', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'com_moa' => ['field_id'=>'modalidad', 'field_name'=>'modalidad', 'entity_name'=>'modalidad'],
  'com_pla' => ['field_id'=>'planificacion', 'field_name'=>'planificacion', 'entity_name'=>'planificacion'],
  'com_pla_plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan'],
  'com_cal' => ['field_id'=>'calendario', 'field_name'=>'calendario', 'entity_name'=>'calendario'],
  'rel' => ['field_id'=>'relacion', 'field_name'=>'relacion', 'entity_name'=>'comision'],
  'rel_sed' => ['field_id'=>'sede1', 'field_name'=>'sede', 'entity_name'=>'sede'],
  'rel_sed_dom' => ['field_id'=>'domicilio2', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'rel_sed_ts' => ['field_id'=>'tipo_sede1', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede'],
  'rel_sed_ce' => ['field_id'=>'centro_educativo1', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo'],
  'rel_sed_ce_dom' => ['field_id'=>'domicilio3', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'rel_moa' => ['field_id'=>'modalidad1', 'field_name'=>'modalidad', 'entity_name'=>'modalidad'],
  'rel_pla' => ['field_id'=>'planificacion1', 'field_name'=>'planificacion', 'entity_name'=>'planificacion'],
  'rel_pla_plb' => ['field_id'=>'plan1', 'field_name'=>'plan', 'entity_name'=>'plan'],
  'rel_cal' => ['field_id'=>'calendario1', 'field_name'=>'calendario', 'entity_name'=>'calendario'],
    ];

    case 'contralor': return [
  'pd' => ['field_id'=>'planilla_docente', 'field_name'=>'planilla_docente', 'entity_name'=>'planilla_docente'],
    ];

    case 'curso': return [
  'com' => ['field_id'=>'comision', 'field_name'=>'comision', 'entity_name'=>'comision'],
  'com_sed' => ['field_id'=>'sede', 'field_name'=>'sede', 'entity_name'=>'sede'],
  'com_sed_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'com_sed_ts' => ['field_id'=>'tipo_sede', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede'],
  'com_sed_ce' => ['field_id'=>'centro_educativo', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo'],
  'com_sed_ce_dom' => ['field_id'=>'domicilio1', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'com_moa' => ['field_id'=>'modalidad', 'field_name'=>'modalidad', 'entity_name'=>'modalidad'],
  'com_pla' => ['field_id'=>'planificacion', 'field_name'=>'planificacion', 'entity_name'=>'planificacion'],
  'com_pla_plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan'],
  'com_cal' => ['field_id'=>'calendario', 'field_name'=>'calendario', 'entity_name'=>'calendario'],
  'asi' => ['field_id'=>'asignatura', 'field_name'=>'asignatura', 'entity_name'=>'asignatura'],
    ];

    case 'designacion': return [
  'car' => ['field_id'=>'cargo', 'field_name'=>'cargo', 'entity_name'=>'cargo'],
  'sed' => ['field_id'=>'sede', 'field_name'=>'sede', 'entity_name'=>'sede'],
  'sed_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'sed_ts' => ['field_id'=>'tipo_sede', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede'],
  'sed_ce' => ['field_id'=>'centro_educativo', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo'],
  'sed_ce_dom' => ['field_id'=>'domicilio1', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona'],
  'per_dom' => ['field_id'=>'domicilio2', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
    ];

    case 'detalle_persona': return [
  'arc' => ['field_id'=>'archivo', 'field_name'=>'archivo', 'entity_name'=>'file'],
  'per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona'],
  'per_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
    ];

    case 'distribucion_horaria': return [
  'asi' => ['field_id'=>'asignatura', 'field_name'=>'asignatura', 'entity_name'=>'asignatura'],
  'pla' => ['field_id'=>'planificacion', 'field_name'=>'planificacion', 'entity_name'=>'planificacion'],
  'pla_plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan'],
    ];

    case 'email': return [
  'per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona'],
  'per_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
    ];

    case 'horario': return [
  'cur' => ['field_id'=>'curso', 'field_name'=>'curso', 'entity_name'=>'curso'],
  'cur_com' => ['field_id'=>'comision', 'field_name'=>'comision', 'entity_name'=>'comision'],
  'cur_com_sed' => ['field_id'=>'sede', 'field_name'=>'sede', 'entity_name'=>'sede'],
  'cur_com_sed_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'cur_com_sed_ts' => ['field_id'=>'tipo_sede', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede'],
  'cur_com_sed_ce' => ['field_id'=>'centro_educativo', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo'],
  'cur_com_sed_ce_dom' => ['field_id'=>'domicilio1', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'cur_com_moa' => ['field_id'=>'modalidad', 'field_name'=>'modalidad', 'entity_name'=>'modalidad'],
  'cur_com_pla' => ['field_id'=>'planificacion', 'field_name'=>'planificacion', 'entity_name'=>'planificacion'],
  'cur_com_pla_plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan'],
  'cur_com_cal' => ['field_id'=>'calendario', 'field_name'=>'calendario', 'entity_name'=>'calendario'],
  'cur_asi' => ['field_id'=>'asignatura', 'field_name'=>'asignatura', 'entity_name'=>'asignatura'],
  'dia' => ['field_id'=>'dia', 'field_name'=>'dia', 'entity_name'=>'dia'],
    ];

    case 'persona': return [
  'dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
    ];

    case 'planificacion': return [
  'plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan'],
    ];

    case 'sede': return [
  'dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'ts' => ['field_id'=>'tipo_sede', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede'],
  'ce' => ['field_id'=>'centro_educativo', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo'],
  'ce_dom' => ['field_id'=>'domicilio1', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
    ];

    case 'telefono': return [
  'per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona'],
  'per_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
    ];

    case 'toma': return [
  'cur' => ['field_id'=>'curso', 'field_name'=>'curso', 'entity_name'=>'curso'],
  'cur_com' => ['field_id'=>'comision', 'field_name'=>'comision', 'entity_name'=>'comision'],
  'cur_com_sed' => ['field_id'=>'sede', 'field_name'=>'sede', 'entity_name'=>'sede'],
  'cur_com_sed_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'cur_com_sed_ts' => ['field_id'=>'tipo_sede', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede'],
  'cur_com_sed_ce' => ['field_id'=>'centro_educativo', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo'],
  'cur_com_sed_ce_dom' => ['field_id'=>'domicilio1', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'cur_com_moa' => ['field_id'=>'modalidad', 'field_name'=>'modalidad', 'entity_name'=>'modalidad'],
  'cur_com_pla' => ['field_id'=>'planificacion', 'field_name'=>'planificacion', 'entity_name'=>'planificacion'],
  'cur_com_pla_plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan'],
  'cur_com_cal' => ['field_id'=>'calendario', 'field_name'=>'calendario', 'entity_name'=>'calendario'],
  'cur_asi' => ['field_id'=>'asignatura', 'field_name'=>'asignatura', 'entity_name'=>'asignatura'],
  'doc' => ['field_id'=>'docente', 'field_name'=>'docente', 'entity_name'=>'persona'],
  'doc_dom' => ['field_id'=>'domicilio2', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'ree' => ['field_id'=>'reemplazo', 'field_name'=>'reemplazo', 'entity_name'=>'persona'],
  'ree_dom' => ['field_id'=>'domicilio3', 'field_name'=>'domicilio', 'entity_name'=>'domicilio'],
  'pd' => ['field_id'=>'planilla_docente', 'field_name'=>'planilla_docente', 'entity_name'=>'planilla_docente'],
    ];

    default: return [];
  }
}
