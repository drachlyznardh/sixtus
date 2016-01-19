var show_left_side = function () {
	document.getElementById('left-side-panel').style.display = 'block';
	document.getElementById('left-side-icon').style.display = 'none';
	hide_right_side();
}
var hide_left_side = function () {
	document.getElementById('left-side-panel').style.display = 'none';
	document.getElementById('left-side-icon').style.display = 'block';
}
var show_right_side = function () {
	document.getElementById('right-side-panel').style.display = 'block';
	document.getElementById('right-side-icon').style.display = 'none';
	hide_left_side();
}
var hide_right_side = function () {
	document.getElementById('right-side-panel').style.display = 'none';
	document.getElementById('right-side-icon').style.display = 'block';
}
var hide_all_sides = function () {
	var w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
	if (w < 801) { hide_left_side(); hide_right_side(); }
	else {
		document.getElementById('left-side-panel').style.display = 'block';
		document.getElementById('left-side-icon').style.display = 'none';
		document.getElementById('right-side-panel').style.display = 'block';
		document.getElementById('right-side-icon').style.display = 'none';
	}
}
var makeTidVisible = function () {
	var rtid = document.getElementById('active-tid').getBoundingClientRect().bottom;
	var rdiv = document.getElementById('right-side').getBoundingClientRect().bottom * 0.75;
	if (rtid > rdiv) div.scrollTop = rtid - rdiv;
	return;
}

function adjustHeight () {
	var relation = document.getElementById('relations');
	var relstyle = window.getComputedStyle(relation);
	var h = document.getElementById('right-side-panel').clientHeight
	var sliding = document.getElementById('sliding-content');
	var slistyle = window.getComputedStyle(sliding);
	h -= relation.offsetHeight + parseFloat(relstyle.marginTop) + parseFloat(relstyle.marginBottom);
	h -= parseFloat(slistyle.marginTop) + parseFloat(slistyle.marginBottom) + parseFloat(slistyle.paddingTop) + parseFloat(slistyle.paddingBottom);
	//alert(style);
	//alert(document.getElementById('right-side-panel').clientHeight);
	//alert(relation.offsetHeight);
	//alert(style.marginTop);
	//alert(style.marginBottom);
	//alert(h);
	sliding.style.height = h.toString().concat('px');
}
