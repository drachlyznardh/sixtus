<?php

	$title = array('Test','For Gr8 Justice');
	$prev = array('Fuffa','NaNoWriMo/Corvino/Multicolore/X/');
	$next = array('Fuffa','NaNoWriMo/Corvino/Multicolore/X/');

	function mkpage ($d) {
		if ($d->isComplete()) {
			$pref = 'nano/corvino/viii.d/';
			echo ('<div class="small">'."\n");
			require_once ($pref.'i.php');
			require_once ($pref.'ii.php');
			require_once ($pref.'iii.php');
			require_once ($pref.'iv.php');
			require_once ($pref.'v.php');
			echo ('</div>'."\n");
		} else {
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
				</li><li id="liv">
					<a onclick="javascript:tab.load('v')">Test V</a>
				</li>
			</ol><p>
				Mostra <a href="<?=$m->getWell()?>">tutto</a>.
			</p>
		</div>
	</div>
</div><script type="text/javascript" src="lib/dloader.js">
</script><script type="text/javascript">
	var tab = new DLoader('NaNoWriMo/Corvino/Multicolore/VIII/', new Array('i','ii','iii','iv','v'));
</script>
<?php }} ?>
