
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

/** Initialization code. 
* If you use your own event management code, change it as required.
*/
if (window.addEventListener)
/** DOMMouseScroll is for mozilla. */
window.addEventListener('DOMMouseScroll', wheel, false);
/** IE/Opera. */
window.onmousewheel = document.onmousewheel = wheel;

