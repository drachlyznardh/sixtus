<?php

	$m->mkpage('Test','For Gr8 Justice');
	$m->mkrelated('prev','Fuffa','NaNoWriMo/Corvino/Multicolore/X/');
	$m->mkrelated('next','Fuffa','NaNoWriMo/Corvino/Multicolore/X/');

	function mkpage ($d, $m) {
?>
<div class="wider">
	<div class="widecontent">
		<div class="tab" id="dynamic">
		</div>
	</div><div class="widelist">
		<div class="section">
			<h2>
				Wide List
			</h2><ol>
				<li id="lii" class="selected">
					<a onclick="javascript:tab.load('i')">Test I</a>
				</li><li id="liii">
					<a onclick="javascript:tab.load('ii')">Test II</a>
				</li><li id="liiii">
					<a onclick="javascript:tab.load('iii')">Test III</a>
				</li><li id="liiv">
					<a onclick="javascript:tab.load('iv')">Test IV</a>
				</li>
			</ol><p>
				Mostra <a onclick="javascript:tab.all(new Array('i','ii','iii','iv','i'))">tutto</a>.
			</p>
		</div>
	</div>
</div><script type="text/javascript">
	var tab = new TLoader('NaNoWriMo/Corvino/Multicolore/VIII/');
	tab.load('i');
</script>
<?php } ?>
