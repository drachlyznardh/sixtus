<?php
	$p->addtitle ('Notizie 2011', 'Blah');
	$p->addside (function ($d) {
?>
<div class="section">
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
</div>
<?php
	});
	$p->addpage (function ($d) {
?>
<div class="small">
	<div class="section">
		<p>
			In ordine crolonogico inverso, le notizie del 2011.
		</p>
	</div>
</div>		
<?php
	});

	$p->set (true, true, false);
	include ('new/2011/11.php');
	include ('new/2011/10.php');
	include ('new/2011/09.php');
	include ('new/2011/08.php');
	include ('new/2011/07.php');
	$d->manypages = true;
?>
