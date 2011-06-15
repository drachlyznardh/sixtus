
var t = new TLoader();

function tcheck () {
	if (!('onhashchange' in window) && confirm(
		'Your browser does not support ‘onhashchange’ event, which I need. Pass to Bolo mode?'
	)) location.replace(location.pathname+'Bolo/'+location.hash);
}

function TLoader () {

	this.show = function (name) {

		name = name.toLowerCase();

		if (name == this.current)
			return;

		var li = document.getElementById('li-'+this.current);
		if (li != undefined)
			li.className='';
		
		var tab = document.getElementById('tab-'+this.current);
		if (tab != undefined)
			tab.style.display='none';
		
		this.current = name;
		
		li = document.getElementById('li-'+this.current);
		if (li != undefined)
			li.className='selected';
		
		tab = document.getElementById('tab-'+this.current);
		if (tab != undefined)
			tab.style.display='block';

		document.getElementById('container').scrollTop = 0;
		location.hash = name.toUpperCase();
	}

	this.current = false;
}
