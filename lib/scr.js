
function Tabler(name) {

	var arrow = document.getElementById('tarrow'+name);
	var tab = document.getElementById('tab'+name);
	
	this.arrow = arrow;
	this.tab = tab;
	this.show = show;
	this.check = check;
	this.check();
}

function show(name, flag) {

	if (this.arrow != undefined) this.arrow.className = '';
	if (this.tab != undefined) this.tab.style.display = 'none';

	this.arrow = document.getElementById('tarrow'+name);
	this.tab = document.getElementById('tab'+name);

	if (this.arrow != undefined) this.arrow.className = 'selected';
	if (this.tab != undefined) this.tab.style.display = 'block';
	
	if (flag != undefined) document.getElementById('container').scrollTop=0;
}

function check() {
	if (location.hash == '#I') this.show('i');
	else if (location.hash == '#II') this.show('ii');
	else if (location.hash == '#III') this.show('iii');
	else if (location.hash == '#IV') this.show('iv');
	else if (location.hash == '#V') this.show('v');
	else this.show('i');
}

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

function showTab(divname, idname) {
	var div = document.getElementById(divname);
	var target = document.getElementById(idname);
	for (i in div.childNodes) {
		var tab = div.childNodes[i];
		if (div.childNodes[i].tagName == 'DIV')
			if (div.childNodes[i].className == 'tab')
				div.childNodes[i].style.display = 'none';
	}
	target.style.display = 'block';
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

function confirmdelete () {

	var del = document.getElementById('deletefile').value;
	var form = document.getElementById('deleteform');
	
	if (confirm('Deleting ' + del + '. Are you sure?'))
		form.submit();
}
