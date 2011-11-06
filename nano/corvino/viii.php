<?php
	$d = $this->d;
	if ($this->addmeta ()) {
		$this->addtitle ('Il lampione','Corvino Multicolore &ndash; VIII', 'i');
		$this->addprev ('NaNoWriMo/Corvino/Multicolore/VII/', 'La dichiarazione');
		#$this->addnext ('NaNoWriMo/Corvino/Multicolore/IX/', 'Capitolo IX');
		$this->prepare ('nano/corvino/index.php', false, false, true);
	} if ($this->addside ()) {
?><div class="section">
	<h2>
		Il lampione
	</h2><ol><li>
			<?=$d->mktid('Quella mattina', 'i')?>
		</li><li>
			<?=$d->mktid('A casa', 'ii')?>
		</li><li>
			<?=$d->mktid('Al parcheggio', 'iii')?>
		</li><li>
			<?=$d->mktid('Di corsa', 'iv')?>
		</li><li>
			<?=$d->mktid('A casa, di nuovo', 'v')?>
		</li><li>
			<?=$d->mktid('Al parco', 'vi')?>
	</li></ol>
</div><?php } if ($this->addpage ()) { ?><div class="small"><?php
	if ($d->mktab('i')) require_once ($d->tab['dir'].'i.php');
	if ($d->mktab('ii')) require_once ($d->tab['dir'].'ii.php');
	if ($d->mktab('iii')) require_once ($d->tab['dir'].'iii.php');
	if ($d->mktab('iv')) require_once ($d->tab['dir'].'iv.php');
	if ($d->mktab('v')) require_once ($d->tab['dir'].'v.php');
	if ($d->mktab('vi')) require_once ($d->tab['dir'].'vi.php');
	if ($d->noTabIncluded()) require_once ('frag404.php');
?></div><?php } ?>
