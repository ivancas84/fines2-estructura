<?php

function get_entity_tree($entityName) {
  switch($entityName){
    case 'alumno': return [

      'pla' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan', 'children'=>[]],
      'ri' => ['field_id'=>'resolucion_inscripcion', 'field_name'=>'resolucion_inscripcion', 'entity_name'=>'resolucion', 'children'=>[]],
      'per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona', 'children'=>[
        'per_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],    ];

    case 'alumno_comision': return [

      'com' => ['field_id'=>'comision', 'field_name'=>'comision', 'entity_name'=>'comision', 'children'=>[
        'com_sed' => ['field_id'=>'sede', 'field_name'=>'sede', 'entity_name'=>'sede', 'children'=>[
          'com_sed_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],
          'com_sed_ts' => ['field_id'=>'tipo_sede', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede', 'children'=>[]],
          'com_sed_ce' => ['field_id'=>'centro_educativo', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo', 'children'=>[
            'com_sed_ce_dom' => ['field_id'=>'domicilio1', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],]],
        'com_moa' => ['field_id'=>'modalidad', 'field_name'=>'modalidad', 'entity_name'=>'modalidad', 'children'=>[]],
        'com_pla' => ['field_id'=>'planificacion', 'field_name'=>'planificacion', 'entity_name'=>'planificacion', 'children'=>[
          'com_pla_plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan', 'children'=>[]],]],
        'com_cal' => ['field_id'=>'calendario', 'field_name'=>'calendario', 'entity_name'=>'calendario', 'children'=>[]],]],
      'alu' => ['field_id'=>'alumno', 'field_name'=>'alumno', 'entity_name'=>'alumno', 'children'=>[
        'alu_pla' => ['field_id'=>'plan1', 'field_name'=>'plan', 'entity_name'=>'plan', 'children'=>[]],
        'alu_ri' => ['field_id'=>'resolucion_inscripcion', 'field_name'=>'resolucion_inscripcion', 'entity_name'=>'resolucion', 'children'=>[]],
        'alu_per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona', 'children'=>[
          'alu_per_dom' => ['field_id'=>'domicilio2', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],]],    ];

    case 'asignacion_planilla_docente': return [

      'pd' => ['field_id'=>'planilla_docente', 'field_name'=>'planilla_docente', 'entity_name'=>'planilla_docente', 'children'=>[]],
      'tom' => ['field_id'=>'toma', 'field_name'=>'toma', 'entity_name'=>'toma', 'children'=>[
        'tom_cur' => ['field_id'=>'curso', 'field_name'=>'curso', 'entity_name'=>'curso', 'children'=>[
          'tom_cur_com' => ['field_id'=>'comision', 'field_name'=>'comision', 'entity_name'=>'comision', 'children'=>[
            'tom_cur_com_sed' => ['field_id'=>'sede', 'field_name'=>'sede', 'entity_name'=>'sede', 'children'=>[
              'tom_cur_com_sed_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],
              'tom_cur_com_sed_ts' => ['field_id'=>'tipo_sede', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede', 'children'=>[]],
              'tom_cur_com_sed_ce' => ['field_id'=>'centro_educativo', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo', 'children'=>[
                'tom_cur_com_sed_ce_dom' => ['field_id'=>'domicilio1', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],]],
            'tom_cur_com_moa' => ['field_id'=>'modalidad', 'field_name'=>'modalidad', 'entity_name'=>'modalidad', 'children'=>[]],
            'tom_cur_com_pla' => ['field_id'=>'planificacion', 'field_name'=>'planificacion', 'entity_name'=>'planificacion', 'children'=>[
              'tom_cur_com_pla_plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan', 'children'=>[]],]],
            'tom_cur_com_cal' => ['field_id'=>'calendario', 'field_name'=>'calendario', 'entity_name'=>'calendario', 'children'=>[]],]],
          'tom_cur_asi' => ['field_id'=>'asignatura', 'field_name'=>'asignatura', 'entity_name'=>'asignatura', 'children'=>[]],]],
        'tom_doc' => ['field_id'=>'docente', 'field_name'=>'docente', 'entity_name'=>'persona', 'children'=>[
          'tom_doc_dom' => ['field_id'=>'domicilio2', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],
        'tom_ree' => ['field_id'=>'reemplazo', 'field_name'=>'reemplazo', 'entity_name'=>'persona', 'children'=>[
          'tom_ree_dom' => ['field_id'=>'domicilio3', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],
        'tom_pd' => ['field_id'=>'planilla_docente1', 'field_name'=>'planilla_docente', 'entity_name'=>'planilla_docente', 'children'=>[]],]],    ];

    case 'calificacion': return [

      'cur' => ['field_id'=>'curso', 'field_name'=>'curso', 'entity_name'=>'curso', 'children'=>[
        'cur_com' => ['field_id'=>'comision', 'field_name'=>'comision', 'entity_name'=>'comision', 'children'=>[
          'cur_com_sed' => ['field_id'=>'sede', 'field_name'=>'sede', 'entity_name'=>'sede', 'children'=>[
            'cur_com_sed_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],
            'cur_com_sed_ts' => ['field_id'=>'tipo_sede', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede', 'children'=>[]],
            'cur_com_sed_ce' => ['field_id'=>'centro_educativo', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo', 'children'=>[
              'cur_com_sed_ce_dom' => ['field_id'=>'domicilio1', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],]],
          'cur_com_moa' => ['field_id'=>'modalidad', 'field_name'=>'modalidad', 'entity_name'=>'modalidad', 'children'=>[]],
          'cur_com_pla' => ['field_id'=>'planificacion', 'field_name'=>'planificacion', 'entity_name'=>'planificacion', 'children'=>[
            'cur_com_pla_plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan', 'children'=>[]],]],
          'cur_com_cal' => ['field_id'=>'calendario', 'field_name'=>'calendario', 'entity_name'=>'calendario', 'children'=>[]],]],
        'cur_asi' => ['field_id'=>'asignatura', 'field_name'=>'asignatura', 'entity_name'=>'asignatura', 'children'=>[]],]],
      'alu' => ['field_id'=>'alumno', 'field_name'=>'alumno', 'entity_name'=>'alumno', 'children'=>[
        'alu_pla' => ['field_id'=>'plan1', 'field_name'=>'plan', 'entity_name'=>'plan', 'children'=>[]],
        'alu_ri' => ['field_id'=>'resolucion_inscripcion', 'field_name'=>'resolucion_inscripcion', 'entity_name'=>'resolucion', 'children'=>[]],
        'alu_per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona', 'children'=>[
          'alu_per_dom' => ['field_id'=>'domicilio2', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],]],
      'dis' => ['field_id'=>'disposicion', 'field_name'=>'disposicion', 'entity_name'=>'disposicion', 'children'=>[
        'dis_asi' => ['field_id'=>'asignatura1', 'field_name'=>'asignatura', 'entity_name'=>'asignatura', 'children'=>[]],
        'dis_pla' => ['field_id'=>'planificacion1', 'field_name'=>'planificacion', 'entity_name'=>'planificacion', 'children'=>[
          'dis_pla_plb' => ['field_id'=>'plan2', 'field_name'=>'plan', 'entity_name'=>'plan', 'children'=>[]],]],]],    ];

    case 'centro_educativo': return [

      'dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],    ];

    case 'comision': return [

      'sed' => ['field_id'=>'sede', 'field_name'=>'sede', 'entity_name'=>'sede', 'children'=>[
        'sed_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],
        'sed_ts' => ['field_id'=>'tipo_sede', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede', 'children'=>[]],
        'sed_ce' => ['field_id'=>'centro_educativo', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo', 'children'=>[
          'sed_ce_dom' => ['field_id'=>'domicilio1', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],]],
      'moa' => ['field_id'=>'modalidad', 'field_name'=>'modalidad', 'entity_name'=>'modalidad', 'children'=>[]],
      'pla' => ['field_id'=>'planificacion', 'field_name'=>'planificacion', 'entity_name'=>'planificacion', 'children'=>[
        'pla_plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan', 'children'=>[]],]],
      'cal' => ['field_id'=>'calendario', 'field_name'=>'calendario', 'entity_name'=>'calendario', 'children'=>[]],    ];

    case 'comision_relacionada': return [

      'com' => ['field_id'=>'comision', 'field_name'=>'comision', 'entity_name'=>'comision', 'children'=>[
        'com_sed' => ['field_id'=>'sede', 'field_name'=>'sede', 'entity_name'=>'sede', 'children'=>[
          'com_sed_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],
          'com_sed_ts' => ['field_id'=>'tipo_sede', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede', 'children'=>[]],
          'com_sed_ce' => ['field_id'=>'centro_educativo', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo', 'children'=>[
            'com_sed_ce_dom' => ['field_id'=>'domicilio1', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],]],
        'com_moa' => ['field_id'=>'modalidad', 'field_name'=>'modalidad', 'entity_name'=>'modalidad', 'children'=>[]],
        'com_pla' => ['field_id'=>'planificacion', 'field_name'=>'planificacion', 'entity_name'=>'planificacion', 'children'=>[
          'com_pla_plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan', 'children'=>[]],]],
        'com_cal' => ['field_id'=>'calendario', 'field_name'=>'calendario', 'entity_name'=>'calendario', 'children'=>[]],]],
      'rel' => ['field_id'=>'relacion', 'field_name'=>'relacion', 'entity_name'=>'comision', 'children'=>[
        'rel_sed' => ['field_id'=>'sede1', 'field_name'=>'sede', 'entity_name'=>'sede', 'children'=>[
          'rel_sed_dom' => ['field_id'=>'domicilio2', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],
          'rel_sed_ts' => ['field_id'=>'tipo_sede1', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede', 'children'=>[]],
          'rel_sed_ce' => ['field_id'=>'centro_educativo1', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo', 'children'=>[
            'rel_sed_ce_dom' => ['field_id'=>'domicilio3', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],]],
        'rel_moa' => ['field_id'=>'modalidad1', 'field_name'=>'modalidad', 'entity_name'=>'modalidad', 'children'=>[]],
        'rel_pla' => ['field_id'=>'planificacion1', 'field_name'=>'planificacion', 'entity_name'=>'planificacion', 'children'=>[
          'rel_pla_plb' => ['field_id'=>'plan1', 'field_name'=>'plan', 'entity_name'=>'plan', 'children'=>[]],]],
        'rel_cal' => ['field_id'=>'calendario1', 'field_name'=>'calendario', 'entity_name'=>'calendario', 'children'=>[]],]],    ];

    case 'contralor': return [

      'pd' => ['field_id'=>'planilla_docente', 'field_name'=>'planilla_docente', 'entity_name'=>'planilla_docente', 'children'=>[]],    ];

    case 'curso': return [

      'com' => ['field_id'=>'comision', 'field_name'=>'comision', 'entity_name'=>'comision', 'children'=>[
        'com_sed' => ['field_id'=>'sede', 'field_name'=>'sede', 'entity_name'=>'sede', 'children'=>[
          'com_sed_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],
          'com_sed_ts' => ['field_id'=>'tipo_sede', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede', 'children'=>[]],
          'com_sed_ce' => ['field_id'=>'centro_educativo', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo', 'children'=>[
            'com_sed_ce_dom' => ['field_id'=>'domicilio1', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],]],
        'com_moa' => ['field_id'=>'modalidad', 'field_name'=>'modalidad', 'entity_name'=>'modalidad', 'children'=>[]],
        'com_pla' => ['field_id'=>'planificacion', 'field_name'=>'planificacion', 'entity_name'=>'planificacion', 'children'=>[
          'com_pla_plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan', 'children'=>[]],]],
        'com_cal' => ['field_id'=>'calendario', 'field_name'=>'calendario', 'entity_name'=>'calendario', 'children'=>[]],]],
      'asi' => ['field_id'=>'asignatura', 'field_name'=>'asignatura', 'entity_name'=>'asignatura', 'children'=>[]],    ];

    case 'designacion': return [

      'car' => ['field_id'=>'cargo', 'field_name'=>'cargo', 'entity_name'=>'cargo', 'children'=>[]],
      'sed' => ['field_id'=>'sede', 'field_name'=>'sede', 'entity_name'=>'sede', 'children'=>[
        'sed_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],
        'sed_ts' => ['field_id'=>'tipo_sede', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede', 'children'=>[]],
        'sed_ce' => ['field_id'=>'centro_educativo', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo', 'children'=>[
          'sed_ce_dom' => ['field_id'=>'domicilio1', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],]],
      'per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona', 'children'=>[
        'per_dom' => ['field_id'=>'domicilio2', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],    ];

    case 'detalle_persona': return [

      'arc' => ['field_id'=>'archivo', 'field_name'=>'archivo', 'entity_name'=>'file', 'children'=>[]],
      'per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona', 'children'=>[
        'per_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],    ];

    case 'disposicion': return [

      'asi' => ['field_id'=>'asignatura', 'field_name'=>'asignatura', 'entity_name'=>'asignatura', 'children'=>[]],
      'pla' => ['field_id'=>'planificacion', 'field_name'=>'planificacion', 'entity_name'=>'planificacion', 'children'=>[
        'pla_plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan', 'children'=>[]],]],    ];

    case 'disposicion_pendiente': return [

      'dis' => ['field_id'=>'disposicion', 'field_name'=>'disposicion', 'entity_name'=>'disposicion', 'children'=>[
        'dis_asi' => ['field_id'=>'asignatura', 'field_name'=>'asignatura', 'entity_name'=>'asignatura', 'children'=>[]],
        'dis_pla' => ['field_id'=>'planificacion', 'field_name'=>'planificacion', 'entity_name'=>'planificacion', 'children'=>[
          'dis_pla_plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan', 'children'=>[]],]],]],
      'alu' => ['field_id'=>'alumno', 'field_name'=>'alumno', 'entity_name'=>'alumno', 'children'=>[
        'alu_pla' => ['field_id'=>'plan1', 'field_name'=>'plan', 'entity_name'=>'plan', 'children'=>[]],
        'alu_ri' => ['field_id'=>'resolucion_inscripcion', 'field_name'=>'resolucion_inscripcion', 'entity_name'=>'resolucion', 'children'=>[]],
        'alu_per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona', 'children'=>[
          'alu_per_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],]],    ];

    case 'distribucion_horaria': return [

      'dis' => ['field_id'=>'disposicion', 'field_name'=>'disposicion', 'entity_name'=>'disposicion', 'children'=>[
        'dis_asi' => ['field_id'=>'asignatura', 'field_name'=>'asignatura', 'entity_name'=>'asignatura', 'children'=>[]],
        'dis_pla' => ['field_id'=>'planificacion', 'field_name'=>'planificacion', 'entity_name'=>'planificacion', 'children'=>[
          'dis_pla_plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan', 'children'=>[]],]],]],    ];

    case 'email': return [

      'per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona', 'children'=>[
        'per_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],    ];

    case 'horario': return [

      'cur' => ['field_id'=>'curso', 'field_name'=>'curso', 'entity_name'=>'curso', 'children'=>[
        'cur_com' => ['field_id'=>'comision', 'field_name'=>'comision', 'entity_name'=>'comision', 'children'=>[
          'cur_com_sed' => ['field_id'=>'sede', 'field_name'=>'sede', 'entity_name'=>'sede', 'children'=>[
            'cur_com_sed_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],
            'cur_com_sed_ts' => ['field_id'=>'tipo_sede', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede', 'children'=>[]],
            'cur_com_sed_ce' => ['field_id'=>'centro_educativo', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo', 'children'=>[
              'cur_com_sed_ce_dom' => ['field_id'=>'domicilio1', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],]],
          'cur_com_moa' => ['field_id'=>'modalidad', 'field_name'=>'modalidad', 'entity_name'=>'modalidad', 'children'=>[]],
          'cur_com_pla' => ['field_id'=>'planificacion', 'field_name'=>'planificacion', 'entity_name'=>'planificacion', 'children'=>[
            'cur_com_pla_plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan', 'children'=>[]],]],
          'cur_com_cal' => ['field_id'=>'calendario', 'field_name'=>'calendario', 'entity_name'=>'calendario', 'children'=>[]],]],
        'cur_asi' => ['field_id'=>'asignatura', 'field_name'=>'asignatura', 'entity_name'=>'asignatura', 'children'=>[]],]],
      'dia' => ['field_id'=>'dia', 'field_name'=>'dia', 'entity_name'=>'dia', 'children'=>[]],    ];

    case 'persona': return [

      'dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],    ];

    case 'planificacion': return [

      'plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan', 'children'=>[]],    ];

    case 'sede': return [

      'dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],
      'ts' => ['field_id'=>'tipo_sede', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede', 'children'=>[]],
      'ce' => ['field_id'=>'centro_educativo', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo', 'children'=>[
        'ce_dom' => ['field_id'=>'domicilio1', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],    ];

    case 'telefono': return [

      'per' => ['field_id'=>'persona', 'field_name'=>'persona', 'entity_name'=>'persona', 'children'=>[
        'per_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],    ];

    case 'toma': return [

      'cur' => ['field_id'=>'curso', 'field_name'=>'curso', 'entity_name'=>'curso', 'children'=>[
        'cur_com' => ['field_id'=>'comision', 'field_name'=>'comision', 'entity_name'=>'comision', 'children'=>[
          'cur_com_sed' => ['field_id'=>'sede', 'field_name'=>'sede', 'entity_name'=>'sede', 'children'=>[
            'cur_com_sed_dom' => ['field_id'=>'domicilio', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],
            'cur_com_sed_ts' => ['field_id'=>'tipo_sede', 'field_name'=>'tipo_sede', 'entity_name'=>'tipo_sede', 'children'=>[]],
            'cur_com_sed_ce' => ['field_id'=>'centro_educativo', 'field_name'=>'centro_educativo', 'entity_name'=>'centro_educativo', 'children'=>[
              'cur_com_sed_ce_dom' => ['field_id'=>'domicilio1', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],]],
          'cur_com_moa' => ['field_id'=>'modalidad', 'field_name'=>'modalidad', 'entity_name'=>'modalidad', 'children'=>[]],
          'cur_com_pla' => ['field_id'=>'planificacion', 'field_name'=>'planificacion', 'entity_name'=>'planificacion', 'children'=>[
            'cur_com_pla_plb' => ['field_id'=>'plan', 'field_name'=>'plan', 'entity_name'=>'plan', 'children'=>[]],]],
          'cur_com_cal' => ['field_id'=>'calendario', 'field_name'=>'calendario', 'entity_name'=>'calendario', 'children'=>[]],]],
        'cur_asi' => ['field_id'=>'asignatura', 'field_name'=>'asignatura', 'entity_name'=>'asignatura', 'children'=>[]],]],
      'doc' => ['field_id'=>'docente', 'field_name'=>'docente', 'entity_name'=>'persona', 'children'=>[
        'doc_dom' => ['field_id'=>'domicilio2', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],
      'ree' => ['field_id'=>'reemplazo', 'field_name'=>'reemplazo', 'entity_name'=>'persona', 'children'=>[
        'ree_dom' => ['field_id'=>'domicilio3', 'field_name'=>'domicilio', 'entity_name'=>'domicilio', 'children'=>[]],]],
      'pd' => ['field_id'=>'planilla_docente', 'field_name'=>'planilla_docente', 'entity_name'=>'planilla_docente', 'children'=>[]],    ];

    default: return [];
  }
}
