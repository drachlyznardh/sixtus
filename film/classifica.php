<?php
	$title=array('Classifica','Cose belle, cose brutte');
	function mkpage($d){
?>
<div class="small">
	<div class="section">
		<h2>
			Fucking awesome!!!
		</h2><p>
			Questi sono decisamente da vedere/provare/comprare.
		</p><ul><li>
				<?=$d->link('Recensioni/AC-Brotherhood/','Assassin&apos;s Creed Brotherhood')?>
			</li></ul>
		</p>
	</div><div class="section">
		<h2>
			Buono
		</h2><ul><li>
				<?=$d->link('Recensioni/CapitanAmerica/','Capitan America')?>
			</li><li>
				<?=$d->link('Recensioni/AngelBeats/','Angel Beats!')?>
		</li></ul>
	</div><div class="section">
		<h2>
			Si lascia guardare
		</h2><p>
			Questi si lasciano guardare. Con le dovute precauzioni.
		</p><ul><li>
				<?=$d->link('Recensioni/Masterforce/','Masterforce')?>
		</li></ul>
	</div><div class="section">
		<h2>
			Meh. / Mah
		</h2><p>
			Questi non sono per tutti, sono per chi ha gusti particolari o lo
			stomaco di ferro.
		</p><ul><li>
				<?=$d->link('Recensioni/Robocop/','Robocop')?>
			</li><li>
				<?=$d->link('Recensioni/PaniPoniDash/','Pani Poni Dash')?>
		</li></ul>
	</div><div class="section">
		<h2>
			L'ha fatto Micheal Bay?
		</h2><ul><li>
			<?=$d->link('Recensioni/Blassreiter/','Blassreiter');?>
		</li></ul>
	</div><div class="section">
		<h2>
			No
		</h2><p>
			Questi no.
		<p><ul><li>
				<?=$d->link('Recensioni/Thor/','Thor')?>
			</li><li>
				<?=$d->link('Recensioni/DarkOfTheMoon/','Dark Of The Moon')?>
		</li></ul>
	</div>
</div>
<?php } ?>
