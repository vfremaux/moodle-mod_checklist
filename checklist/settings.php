<?php

$options = array('0' => get_string('no'), '1' => get_string('yes'));
$settings->add(new admin_setting_configselect('checklist_autoupdate_use_cron', get_string('checklist_autoupdate_use_cron', 'checklist'), get_string('configchecklistautoupdateusecron', 'checklist'), '0', $options));
