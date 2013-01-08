<?php

/**
* @package mod-checklist
* @author valery fremaux
*
* This board summarizes the tutor's coaching activity within the course
*/

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');
require_once(dirname(__FILE__).'/locallib.php');

$id = optional_param('id', 0, PARAM_INT); // course_module ID, or
$checklist  = optional_param('checklist', 0, PARAM_INT);  // checklist instance ID
$studentid = optional_param('studentid', false, PARAM_INT);

if ($id) {
    if (! $cm = get_coursemodule_from_id('checklist', $id)) {
        error('Course Module ID was incorrect');
    }

    if (! $course = get_record('course', 'id', $cm->course)) {
        error('Course is misconfigured');
    }

    if (! $checklist = get_record('checklist', 'id', $cm->instance)) {
        error('Course module is incorrect');
    }

} else if ($checklist) {
    if (! $checklist = get_record('checklist', 'id', $checklist)) {
        error('Course module is incorrect');
    }
    if (! $course = get_record('course', 'id', $checklist->course)) {
        error('Course is misconfigured');
    }
    if (! $cm = get_coursemodule_from_instance('checklist', $checklist->id, $course->id)) {
        error('Course Module ID was incorrect');
    }

} else {
    error('You must specify a course_module ID or an instance ID');
}

$context = get_context_instance(CONTEXT_COURSE, $course->id);

require_login($course, true, $cm);
require_capability('mod/checklist:viewtutorboard', $context);

$chk = new checklist_class($cm->id, $studentid, $checklist, $cm, $course);

$chk->tutorboard($course);
