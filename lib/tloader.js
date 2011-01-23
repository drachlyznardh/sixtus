
function TLoader () {

	this.show = function (name) {

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
	}

	this.current = false;
}
