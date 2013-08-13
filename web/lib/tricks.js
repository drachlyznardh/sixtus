function dadd(dest, source) {
	var button = document.getElementById('plus-'+dest);
	if (button == undefined) alert ('ObjNULL');
	if (button.className == 'removable') {
		button.className = 'addable';
		remove('dynamic-'+dest);
		return false;
	} else {
		button.className = 'removable';
		add('dynamic-'+dest, source);
		return true;
	}
}

function remove(destination) {
	var div = document.getElementById(destination);
	div.style.display = 'none';
	div.innerHTML = '';
}

function add(destination, source) {
	req = new XMLHttpRequest();
	req.open('GET','dynamic/'+source,false);
	req.send();
	var div = document.getElementById(destination);
	div.innerHTML=req.responseText;
	div.style.display = 'block';
	var dyscr = document.getElementById('dyscr');
	if (dyscr != undefined) return eval(dyscr.innerHTML);
}

function reverse (name) {

	var target = document.getElementById('long'+name);
	var arrow = document.getElementById('straight'+name);
	var regex = new RegExp('revwider');
	var revex = new RegExp('wider');

	if (target.className.match(regex)) {
		target.className = target.className.replace(regex, ' ') + ' wider';
		arrow.className = arrow.className.replace(regex, ' ') + ' wider';
	} else {
		target.className = target.className.replace(revex, ' ') + 'revwider';
		arrow.className = arrow.className.replace(revex, ' ') + ' revwider reverse';
	}
}

function cascade (name) {

	var target = document.getElementById ('long'+name);
	var arrow = document.getElementById ('arrow'+name);

	if (target.style.display == 'none') {
		target.style.display = 'block';
		if (arrow) arrow.className = arrow.className.replace(new RegExp('closed'), ' ') + ' opened';
	} else {
		target.style.display = 'none';
		if (arrow) arrow.className = arrow.className.replace(new RegExp('opened'), ' ') + 'closed';
	}
}

