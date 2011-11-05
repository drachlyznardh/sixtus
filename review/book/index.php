<?php
	$d = $this->d;
	if ($this->addmeta ()) {
		$this->addtitle ('Libri', 'Letti a spasso');
	} if ($this->addpage ()) {
?><div class="small">
	<?php if ($d->mktab('') or $d->mktab('categorie')) { ?><div class="section">
		<h2><a id="Libri"></a>
			Libri
		</h2><p>
			Ora, io non leggo moltissimo; non ho mai letto molto nella mia vita.
			Ma poi ho realizzato due cose:
		</p><ul><li>
				sono abbastanza bravo a fare due cose alla volta
			</li><li>
				mentre vado da un posto all'altro, non ho niente da fare
		</li></ul><p>
			Ho così cominciato a leggere durante i miei spostamenti. Ecco quel
			che ho letto (recentemente) mentre camminavo.
		</p>
	</div><?php } ?>
</div><?php } if ($this->addside ()) { ?><div class="section">
	<h2 class="reverse">
		Libri
	</h2><p>
			<?=$d->link('Recensioni/Libri/XI/', 'Nessun Dove', 'I')?> – 1996
		</p><p>
			<?=$d->link('Recensioni/Libri/XII/', 'Harry Potter &amp; …', 'I')?>
			– 1997~2007
	</p>
</div><?php } ?>
