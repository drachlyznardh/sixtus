<?php
	$title = array ('(Video)Giochi', 'Qualcosa faccio anch&apos;io');
	$pages[] = function ($d) {
?>
<div class="small">
	<?php if ($d->mktab('') or $d->mktab('categorie')) { ?><div class="section">
		<h2><a id="Giochi"></a>
			(Video)Giochi
		</h2><p>
			Beh, io non sarà <span class="jazz">Jazz</span>, ma gioco un
			pochettino. Qualche parere anche in questo campo.
		</p>
	</div><?php } ?>
</div>
<?php
	};
	$sides[] = function ($d) {
?>
<div class="section">
	<h2 class="reverse">
		Giochi
	</h2><p>
			<?=$d->link('Recensioni/Giochi/II/', 'Assassin&apos;s Creed Brotherhood')?> – 2010
	</p>
</div>
<?php } ?>
