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
}
var makeTidVisible = function () {
	var rtid = document.getElementById('active-tid').getBoundingClientRect().bottom;
	var rdiv = document.getElementById('right-side').getBoundingClientRect().bottom * 0.75;
	if (rtid > rdiv) div.scrollTop = rtid - rdiv;
	return;
}
