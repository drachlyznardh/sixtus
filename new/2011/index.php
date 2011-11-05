<?php
	$d = $this->d;
	if ($this->addmeta()) {
		$this->addtitle ('Notizie 2011', 'Blah');
		$this->prepare ('new/2011/11.php', false, true, true);
		$this->prepare ('new/2011/10.php', false, true, true);
		$this->prepare ('new/2011/09.php', false, true, true);
		$this->prepare ('new/2011/08.php', false, true, true);
		$this->prepare ('new/2011/07.php', false, true, true);
	} if ($this->addside ()) {
?><div class="section">
	<h2>
		2011
	</h2><p>
		<?=$d->link('News/2011/07/', 'Luglio')?>
		/ <?=$d->link('News/2011/08/', 'Agosto')?>
		/ <?=$d->link('News/2011/09/', 'Settembre')?>
	</p><p>
		<?=$d->link('News/2011/10/', 'Ottobre')?>
		/ <?=$d->link('News/2011/11/', 'Novembre')?>
		/ Dicembre
	</p>
</div><?php } if ($this->addpage ()) { ?><div class="small">
	<div class="section">
		<p>
			In ordine crolonogico inverso, le notizie del 2011.
		</p>
	</div>
</div><?php } ?>
