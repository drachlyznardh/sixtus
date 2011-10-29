<div class="section">
	<?php $p = 'NaNoWriMo/Corvino/Multicolore/'; ?>

	<h2 class="opened" id="arrowchapters" onmousedown="javascript:cascade('chapters')">
		Corvino Multicolore
	</h2><p>
		<?=$d->link($p, 'Indice')?>
	</p><p>
		<?=$d->link($p.'Personaggi/', 'Personaggi')?>
	</p><p>
		<?=$d->link($p.'Extra/', 'Extra')?>
	</p><div id="longchapters">
		<h2 class="reverse">
			La Gioventù
		</h2><div class="inside">
			<ol style="list-style-type:upper-roman">
				<li>
					<?=$d->link($p.'I/', 'Una sera, al parco')?>
				</li><li>
					<?=$d->link($p.'II/', 'Al campeggio')?>
				</li><li>
					<?=$d->link($p.'III/', 'A contatto')?>
				</li><li>
					<?=$d->link($p.'IV/', 'Nel bosco')?>
				</li><li>
					<?=$d->link($p.'V/', 'Di notte')?>
				</li><li>
					<?=$d->link($p.'VI/', 'Gli ultimi giorni')?>
				</li><li>
					<?=$d->link($p.'VII/', 'La dichiarazione')?>
				</li>
			</ol>
		</div><h2 class="reverse">
			Il Potere
		</h2><div class="inside">
			<ol style="list-style-type:upper-roman" start="8">
				<li>
					<?=$d->link($p.'VIII/', 'Il lampione')?>
				</li>
			</ol>
		</div><h2 class="reverse">
			Le Streghe
		</h2><!--div class="inside"-->
			<p>Prossimamente...</p>
		<!--/div--><h2 class="reverse">
			I Demoni
		</h2><!--div class="inside"-->
			<p>Ancor meno prossimamente...</p>
		<!--/div-->
	</div>
</div>
<?php require_once ('tmpl/side/.disclaimer.php'); ?>
