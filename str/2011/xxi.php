<?php

	$title = array(
		'Progammazione 40.000',
		'L&apos;Imperium contro gli orrori del Warp');
	$prev = array('Storia XX','Storie/2011/XX/');
	$next = array('Storia XXII', 'Storie/2011/XXII/');

	function mkpage($d) {
		if ($d->isComplete()) {
			$pref = 'str/2011/xxi.d/';
			echo ('<div class="small">'."\n");
			require_once($pref.'i.php');
			require_once($pref.'ii.php');
			require_once($pref.'iii.php');
			echo ('</div>'."\n");
		} else {
?>
<div class="wider">
	<div class="widecontent">
		<div id="dynamic"></div>
	</div><div class="widelist">
		<div class="section">
			<h2>
				Sezioni
			</h2><ol>
				<li id="lii">
					<a onclick="javascript:tab.load('i')">La storia</a>
				</li><li id="liii">
					<a onclick="javascript:tab.load('ii')">La storia vera</a>
				</li><li id="liiii">
					<a onclick="javascript:tab.load('iii')">La fine che dovrebbero fare</a>
				</li>
			</ol>
		</div>
	</div>
</div><script type="text/javascript" src="lib/dloader.js">
</script><script type="text/javascript">
	var tab = new DLoader('Storie/2011/XXI/', new Array('i','ii','iii'));
</script>
<?php }} ?>
