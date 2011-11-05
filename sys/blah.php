<?php
	if ($p->addmeta()) {
		$this->addtitle ('Blah', 'La pagina che potrebbe salvarmi', 'intro');
	} if ($p->addpage()) { 
?><div class="small">
	<div class="section">
		<h2>
			Blah
		</h2><p>
			Questo è Blah.page
		</p>
	</div>
</div><?php
	} if ($p->addside()) {
?><div class="section">
	<h2>
		Blah
	</h2><p>
		Questo è Blah.side
	</p>
</div><?php
	}
?>
