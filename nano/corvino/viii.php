<?php

	$m->mkpage('Il lampione','Corvino Multicolore &ndash; VIII');
	$m->mkrelated('prev','Capitolo VII','NaNoWriMo/Corvino/Multicolore/VII/');
	$m->mkrelated('next','Capitolo IX','NaNoWriMo/Corvino/Multicolore/IX/');

	require_once ($loco->mklib('tabler'));

	function mkpage ($d, $m) {

		$t = new Tabler ($d, $m, 'VIII', 'nano/corvino/viii.d/');
?>
<div class="wider">
	<div class="widelist">
		<div class="section">
			<ol style="list-style-type:lower-roman">
				<?php
					$t->mkli ('Quella mattina', 'i');
					$t->mkli ('A casa', 'ii');
					$t->mkli ('Al parcheggio', 'iii');
					$t->mkli ('Di corsa', 'iv');
					$t->mkli ('A casa, di nuovo', 'v');
				?>
			</ol>
		</div>
	</div><div class="widecontent">
		<?php
			$t->mktab ('i', 'Quella mattina', 'i.php', 'ii');
			$t->mktab ('ii',  'A casa', 'ii.php', 'iii');
			$t->mktab ('iii', 'Al parcheggio', 'iii.php', 'iv');
			$t->mktab ('iv',  'Di corsa', 'iv.php', 'iv');
			$t->mktab ('v',   'A casa, di nuovo', 'v.php');
		?>
	</div>
</div>
<script type="text/javascript">var tab = new Tabler('i')</script>
<?php } ?>
