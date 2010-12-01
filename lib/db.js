function setFormData (field, value, id) {

	document.getElementById ('update-legend').innerHTML = "Modifica riga#" + id;
	document.getElementById ('update-label').innerHTML = field;
	document.getElementById ('update-field').value = field;
	document.getElementById ('update-id').value = id;
	document.getElementById ('update-input').value = value;
	
	setTimeout (setFocus, 10);
}

function setFocus () {

	document.getElementById ('update-input').focus ();
}

function checkRemove (id) {

	document.getElementById ('remove-input').value = id;
	var response = confirm ("Are you sure you want to delete line `" + id + "`?");
	if (response) document.getElementById ('remove-form'). submit ();
}

