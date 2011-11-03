<div class="small">
	<div class="section">
		<?=$finder->show()?>
	</div><div class="section">
		<p>
			Now debugging...
		</p><h2>
			Search
		</h2><p>
			<span class="em">Request</span>: <?=$request?>
		</p><p>
			<span class="em">Category</span>: <?php
				foreach ($search['category'] as $category)
					echo ($category .' / ');
			?>
		</p><p>
			<span class="em">Destdir</span>: <?=$search['destdir']?>
		</p><p>
			<span class="em">Last</span>: <?=$search['last']?>
		</p><p>
			<span class="em">Self</span>: <?=$self?>
		</p><p>
			<span class="em">Page</span>: <?=$page?>
		</p><p>
			<span class="em">Tab</span>: <?=$tab['name']?>, (<?=$tab['dir']?>, <?=$tab['req']?>)
		</p><p>
			<span class="em">RSide</span>: <?=$rside?>
		</p>
	</div><div class="section">
		<h2>
			Options
		</h2><?php
			foreach (array_keys($opt) as $key)
				echo ('<p><span class="em">'. $key .'</span>: '. $opt[$key] .'</p>');
		?>
	</div>
</div>
