
function DLoader (pref, values) {

	this.check = function(name) {
		li = document.getElementById('li'+this.current);
		if (li != undefined) li.className = '';
		li = document.getElementById('li'+name);
		if (li != undefined) li.className = 'selected';
		this.current = name;
	}
	this.all = function () {

		if (this.current == 'all') return;

		i = 0;
		this.check('all');
		xmlhttp = new XMLHttpRequest();
		document.getElementById('dynamic').innerHTML = '';

		while (i < this.values.length) {
			xmlhttp.open('GET', 'dynamic/'+this.pref+this.values[i]+'/',false);
			xmlhttp.send();
			document.getElementById('dynamic').innerHTML += xmlhttp.responseText;
			i++;
		}
	}
	this.load = function (name) {

		if (name == this.current) return;

		this.check(name);

		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange=this.onload;
		xmlhttp.open('GET', 'dynamic/'+this.pref+name+'/', false);
		xmlhttp.send();
		document.getElementById('dynamic').innerHTML = xmlhttp.responseText;
		document.getElementById('container').scrollTop = 0;
	}

	this.values = values;
	this.pref = pref;
	this.load(this.values[0]);
}
