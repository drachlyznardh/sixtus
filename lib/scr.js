
function showOrHide (target, type) {

	var obj = document.getElementById (target + '-div');
	var alt = document.getElementById (target + '-alt');

	if (!type) type = 'block';

	if (obj.style.display == 'none') {
		
		obj.style.display = type;
		if (alt != undefined) alt.style.display = 'none';
		
	} else {
		
		obj.style.display = 'none';
		if (alt != undefined) alt.style.display = type;
	}
}

function showOrHideColumn (target, howmany) {

	var obj;

	for (var index = 0; index < howmany; index++) {
	
		obj = document.getElementById (target + index);
		
		if (obj != undefined) {
		
			if (obj.style.display == 'none') obj.style.display = 'table-cell';
			else obj.style.display = 'none';
		}
	}
}

function showOrHideLines (target, howmany) {

	var obj;

	for (var index = 0; index < howmany; index++) {
	
		obj = document.getElementById (target + index);
		
		if (obj != undefined) {
		
			if (obj.style.display == 'none') obj.style.display = 'table-row';
			else obj.style.display = 'none';
		}
	}
}

function updateStyle (classname, element, value) {

	var key;
	var i, j;

	for (var i = 0; i < document.styleSheets.length; i++) {

		if (document.styleSheets[i]['rules']) key = 'rules';
		else if (document.styleSheets[i]['cssRules']) key = 'cssRules';

		for (var j = 0; j < document.styleSheets[i][key].length; j++) {

			if (document.styleSheets[i][cssRules][key].selectorText == classname) {

				if (document.styleSheets[i][cssRules][key].style[element]) {
					document.styleSheets[i][cssRules][key].style[element] = value;
					break;
				}
			}
		}
	}
}
