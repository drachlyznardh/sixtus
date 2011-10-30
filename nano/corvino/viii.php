<?php
	$title=array('Il lampione','Corvino Multicolore &ndash; VIII');
	$prev=array('Capitolo VII','NaNoWriMo/Corvino/Multicolore/VII/');
	$next=array('Capitolo IX','NaNoWriMo/Corvino/Multicolore/IX/');
	function mkpage ($d) {
?>
<div class="wider">
	<div class="widelist">
		<div class="section">
			<ol style="list-style-type:lower-roman">
				<li>
					<?=$d->mktid($d->self, 'Quella mattina', 'i')?>
				</li><li>
					<?=$d->mktid($d->self, 'A casa', 'ii')?>
				</li><li>
					<?=$d->mktid($d->self, 'Al parcheggio', 'iii')?>
				</li><li>
					<?=$d->mktid($d->self, 'Di corsa', 'iv')?>
				</li><li>
					<?=$d->mktid($d->self, 'A casa, di nuovo', 'v')?>
				</li><li>
					<?=$d->mktid($d->self, 'Al parco', 'vi')?>
				</li>
			</ol>
		</div>
	</div><div class="widecontent">
		<?php
			if ($d->mktab('i')) require_once ($d->tabbase.'i.php');
			if ($d->mktab('ii')) require_once ($d->tabbase.'ii.php');
			if ($d->mktab('iii')) require_once ($d->tabbase.'iii.php');
			if ($d->mktab('iv')) require_once ($d->tabbase.'iv.php');
			if ($d->mktab('v')) require_once ($d->tabbase.'v.php');
			if ($d->mktab('vi')) require_once ($d->tabbase.'vi.php');
		?>
	</div>
</div>
<?php } ?>
