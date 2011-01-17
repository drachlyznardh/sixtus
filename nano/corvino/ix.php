<?php

	$m->mkpage('Test','For Gr8 Justice');

	function mkpage ($d, $m) {
?>
<div class="small">
	<div class="section">
		<h2>
			Test
		</h2><p>
			Testing...
		</p>
	</div>
</div><div class="wider">
	<div class="widecontent" id="dynamic">
	</div><div class="widelist">
		<div class="section">
			<h2>
				Wide List
			</h2><ol>
				<li id="li1">
					<a onclick="javascript:tab.load('i')">Test I</a>
				</li><li id="li2">
					<a onclick="javascript:tab.load('ii')">Test II</a>
				</li><li id="li3">
					<a onclick="javascript:tab.load('iii')">Test III</a>
				</li><li id="li4">
					<a onclick="javascript:tab.load('iv')">Test IV</a>
				</li>
			</ol>
		</div>
	</div>
</div><script type="text/javascript">
function TLoader (pref) {
	this.pref = pref;
	this.load = TLoader_load;
}
var tab = new TLoader('NaNoWriMo/Corvino/Multicolore/VIII/');
function TLoader_load (name) {
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById('dynamic').innerHTML=xmlhttp.responseText;
			document.getElementById('container').scrollTop = 0;
		}
	}
	xmlhttp.open('GET', 'dynamic/'+this.pref+name+'/', true);
	xmlhttp.send();
}
</script>
<?php } ?>
