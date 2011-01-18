<?php

	$m->getPage()->setAttr('Il lampione','Corvino Multicolore &ndash; VIII');
	$m->getPage()->setOption('multipart');
	$m->getPage()->setRelated('prev','Capitolo VII','NaNoWriMo/Corvino/Multicolore/VII/');
	$m->getPage()->setRelated('next','Capitolo IX','NaNoWriMo/Corvino/Multicolore/IX/');

	require_once ($loco->mklib('tabler'));

	function mkpage ($d, $m) {
		if ($m->checkMode('complete')) {
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
	<div class="widelist">
		<div class="section">
			<ol style="list-style-type:lower-roman">
				<li id="lii">
					<a onclick="javascript:tab.load('i')">Quella mattina</a>
				</li><li id="liii">
					<a onclick="javascript:tab.load('ii')">A casa</a>
				</li><li id="liiii">
					<a onclick="javascript:tab.load('iii')">Al parcheggio</a>
				</li><li id="liiv">
					<a onclick="javascript:tab.load('iv')">Di corsa</a>
				</li><li id="liv">
					<a onclick="javascript:tab.load('v')">A casa, di nuovo</a>
				</li>
			</ol>
		</div>
	</div><div class="widecontent">
		<div class="tab" id="dynamic" />
	</div>
</div>
<script type="text/javascript" src="lib/dloader.js"></script><script type="text/javascript">
	var tab = new DLoader('NaNoWriMo/Corvino/Multicolore/VIII/', new Array('i','ii','iii','iv','v'));
</script>
<?php }} ?>
