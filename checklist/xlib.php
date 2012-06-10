<?php

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

	// get only teacher validated marks to assess the credit time
	$sql = "
		SELECT
			ci.id,
			cc.userid,
			ci.moduleid ".sql_as()." cmid,
			credittime * 60 ".sql_as()." credittime,
			m.name ".sql_as()." modname
		FROM
			{$CFG->prefix}modules m
		JOIN
			{$CFG->prefix}course_modules cm
		ON 
			m.id = cm.module
		JOIN
			{$CFG->prefix}checklist_item ci
		ON
			cm.id = ci.moduleid
		LEFT JOIN
			{$CFG->prefix}checklist_check cc
		ON
			ci.id = cc.item AND
			teachermark = 1
		WHERE
			1 = 1
			$checklistclause
			$cmclause
			$userclause
	";
	
	return get_records_sql($sql);
}

?>