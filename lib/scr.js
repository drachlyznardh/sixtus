
function myKeyUp (e) {
	var key = (window.event) ? event.keyCode : e.keyCode;
	var div = document.getElementById('container');
	switch (key) {
	
		case 38: div.scrollTop -= 30; break;
		case 33: div.scrollTop -= 300; break;
		case 36: div.scrollTop = 0; break;
		case 40: div.scrollTop += 30; break;
		case 34: div.scrollTop += 300; break;
		case 35: div.scrollTop = div.scrollHeight; break;
	}
}

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
		arrow.className = arrow.className.replace(new RegExp('closed'), ' ') + ' opened';
	} else {
		target.style.display = 'none';
		arrow.className = arrow.className.replace(new RegExp('opened'), ' ') + 'closed';
	}
}

function wheel(event) {

	var delta = 0;
	var target;

	if (!event) event = window.event;
	
	if (event.wheelDelta) { 
		delta = event.wheelDelta/120;
		target = event.srcElement;
		if (window.opera) delta = -delta;
	} else if (event.detail) { 
		delta = -event.detail/3;
		target = event.target;
	}

	if (delta) {

		var div = target.parentNode;

		while (true) {

			if (div == null)
				return;

			if (div.tagName == 'DIV')
				if (div.getAttribute('class') == 'scrollable')
					break;
			div = div.parentNode;
		}

		div.scrollTop -= 15*delta;
	}
	if (event.preventDefault)
		event.preventDefault();
	event.returnValue = false;
}

if (window.addEventListener)
	window.addEventListener('DOMMouseScroll', wheel, false);

window.onmousewheel = document.onmousewheel = wheel;
document.onkeypress = myKeyUp;
