<?php

	$title=array('Il lampione','Corvino Multicolore &ndash; VIII');
	$prev=array('Capitolo VII','NaNoWriMo/Corvino/Multicolore/VII/');
	$next=array('Capitolo IX','NaNoWriMo/Corvino/Multicolore/IX/');

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
	<div class="widelist">
		<div class="section">
			<ol style="list-style-type:lower-roman">
				<li id="lii">
					<a onclick="javascript:t.load('i')">Quella mattina</a>
				</li><li id="liii">
					<a onclick="javascript:t.load('ii')">A casa</a>
				</li><li id="liiii">
					<a onclick="javascript:t.load('iii')">Al parcheggio</a>
				</li><li id="liiv">
					<a onclick="javascript:t.load('iv')">Di corsa</a>
				</li><li id="liv">
					<a onclick="javascript:t.load('v')">A casa, di nuovo</a>
				</li>
			</ol>
		</div>
	</div><div class="widecontent">
		<div id="dynamic" />
	</div>
</div>
<script type="text/javascript" src="lib/dloader.js"></script><script type="text/javascript">
	var t = new DLoader('NaNoWriMo/Corvino/Multicolore/VIII/');
	tab.load('i');
</script>
<?php }} ?>
