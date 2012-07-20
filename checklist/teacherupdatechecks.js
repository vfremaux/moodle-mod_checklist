function checklist_release_declaredtime_select(sourceelm, itemid){
	var YD = YAHOO.util.Dom;	
	
	targetelm = YD.get('declaredtime'+itemid);
	if (sourceelm.options[sourceelm.options.selectedIndex].value != itemid + ':0'){
		targetelm.disabled = false;
	} else {
		targetelm.options.selectedIndex = 0;
		targetelm.disabled = true;
	}
	
}

function checklist_updatechecks_show(){
	var YD = YAHOO.util.Dom;	
	YD.setStyle('checklistsavechecks', 'display', 'block');
}

