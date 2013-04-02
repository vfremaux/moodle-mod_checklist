<?php

require_once $CFG->dirroot.'/mod/checklist/locallib.php';

function checklist_get_instances($courseid, $usecredit = null){
	
	if ($usecredit){
		$creditclause = ' AND usetimecounterpart = 1 ';
	} else if ($usecredit === false) {
		$creditclause = ' AND usetimecounterpart = 0 ';
	} else {
		$creditclause = '';
	}
	
	if ($checklists = get_records_select('checklist', " course = $courseid $creditclause ")){
		return $checklists;
	}
	return array();
}

/**
* @param int $checklistid
* @param int $cmid
* @param int $userid
* @return validated credittimes on course modules with several filters.
* credittime values are normalized in secs.
*
*/
function checklist_get_credittimes($checklistid = 0, $cmid = 0, $userid = 0){
    global $CFG;
    
    $checklistclause = ($checklistid) ? " AND ci.checklist = $checklistid " : '' ;
    $cmclause = ($cmid) ? " AND cm.id = $cmid " : '' ;
    $userclause = ($userid) ? " AND cc.userid = $userid " : '' ;
    $checklist = get_record('checklist', 'id', "$checklistid");
    $teachermarkclause = '';
    if ($checklist->teacheredit > CHECKLIST_MARKING_STUDENT){
    	$teachermarkclause = " AND teachermark = 1 ";
    }

	// get only teacher validated marks to assess the credit time
	$sql = "
		SELECT
			ci.id,
			cc.userid,
			ci.moduleid ".sql_as()." cmid,
			ci.credittime * 60 ".sql_as()." credittime,
			m.name ".sql_as()." modname
		FROM
			{$CFG->prefix}checklist_check cc
		JOIN
			{$CFG->prefix}checklist_item ci
		ON
			ci.id = cc.item
			$checklistclause
			$userclause
		LEFT JOIN
			{$CFG->prefix}course_modules cm
		ON
			cm.id = ci.moduleid
		LEFT JOIN
			{$CFG->prefix}modules m
		ON 
			m.id = cm.module
		WHERE
			ci.enablecredit = 1
			$teachermarkclause
			$cmclause
	";
	
	return get_records_sql($sql);
}

/**
* @param int $checklistid
* @param int $cmid
* @param int $userid
* @return validated credittimes on course modules with several filters.
* credittime values are normalized in secs.
*
*/
function checklist_get_declaredtimes($checklistid, $cmid = 0, $userid = 0){
    global $CFG, $USER;
    
    $checklistclause = ($checklistid) ? " AND ci.checklist = $checklistid " : '' ;
    $cmclause = ($cmid) ? " AND cm.id = $cmid " : '' ;
    $userclause = ($userid) ? " AND cc.userid = $userid " : '' ;
    $checklist = get_record('checklist', 'id', "$checklistid");
    $teachermarkedclause = '';
    if ($checklist->teacheredit > CHECKLIST_MARKING_STUDENT){
    	$teachermarkedclause = " AND teachermark = 1 ";
    }

	// TODO : resolve inconsistancy for checklistid = 0 vs. explicit watcher status against checklist instance   
	$cklcm = get_coursemodule_from_instance('checklist', $checklistid);
    $context = get_context_instance(CONTEXT_MODULE, $cklcm->id);
    
    if (has_capability('mod/checklist:updateother', $context) && $userid == $USER->id){

		// assessor case when self viewing 
		// get sum of teacherdelcaredtimes you have for each explicit module, or default module to checklist itself (NULL)
		// note the primary key is a pseudo key calculated for unicity, not for use.
		$sql = "
			SELECT
			    MAX(ci.id) as id,
				cc.teacherid,
				ci.moduleid ".sql_as()." cmid,
				SUM(cc.teacherdeclaredtime) * 60 ".sql_as()." declaredtime,
				m.name ".sql_as()." modname
			FROM
				{$CFG->prefix}checklist_check cc
			JOIN
				{$CFG->prefix}checklist_item ci
			ON
				ci.id = cc.item
			LEFT JOIN
				{$CFG->prefix}course_modules cm
			ON
				cm.id = ci.moduleid
			LEFT JOIN
				{$CFG->prefix}modules m
			ON 
				m.id = cm.module
			WHERE
				cc.teacherid = $userid
				$teachermarkedclause
				$checklistclause
				$cmclause
			GROUP BY
				cc.teacherid,
				cmid
		";
		
		// echo "teacher $sql <br/>";
		
		return get_records_sql($sql);
    	
	} else {

    	// student case.

		// get only teacher validated marks to assess the declared time
		$sql = "
			SELECT
				ci.id,
				cc.userid,
				ci.moduleid ".sql_as()." cmid,
				cc.declaredtime * 60 ".sql_as()." declaredtime,
				m.name ".sql_as()." modname
			FROM
				{$CFG->prefix}checklist_check cc
			JOIN
				{$CFG->prefix}checklist_item ci
			ON
				ci.id = cc.item
				$userclause
				$checklistclause
			LEFT JOIN
				{$CFG->prefix}course_modules cm
			ON
				cm.id = ci.moduleid
			LEFT JOIN
				{$CFG->prefix}modules m
			ON 
				m.id = cm.module
			WHERE
				1 = 1
				$teachermarkedclause
				$cmclause
		";
		
		// echo "Student : $sql <br/>";
		
		return get_records_sql($sql);
	}
}

?>