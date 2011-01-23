
function DLoader (pref) {

	this.check = function(name) {
		li = document.getElementById('li'+this.current);
		if (li != undefined) li.className = '';
		li = document.getElementById('li'+name);
		if (li != undefined) li.className = 'selected';
		this.current = name;
	}
	this.load = function (name) {

		if (name == this.current) return;

		this.check(name);

		xmlhttp = new XMLHttpRequest();
		xmlhttp.open('GET', 'dynamic/'+this.pref+name+'/', false);
		xmlhttp.send();
		document.getElementById('dynamic').innerHTML = xmlhttp.responseText;
		document.getElementById('container').scrollTop = 0;
	}

	this.pref = pref;
}
