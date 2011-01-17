<?php

	$m->mkpage(
		'Progammazione 40.000',
		'L&apos;Imperium contro gli orrori del Warp');
	$m->mkrelated('prev','Storia XX','Storie/2011/XX/');

	function mkpage($d, $m) {
?>
<div class="wider">
	<div class="widecontent">
		<div class="tab" id="dynamic"></div>
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
			</ol><p>
				Oppure, <a onclick="javascript:tab.all(new
				Array('i','ii','iii'))">mostra</a> tutte le sezioni.
			</p>
		</div>
	</div>
</div><script type="text/javascript">
	tab = new TLoader('Storie/2011/XXI/');
	tab.load('i');
</script>
<?php } ?>
