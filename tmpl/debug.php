		<div class="section">
			<p>
				Debug! Debug infos everywhere!!!
			</p>
		</div><div class="wider">
			<div class="widelist">
				<div class="section">
					<h2>Category</h2>
					<p>
<?php
	foreach(array_keys($cats) as $key) {
		echo ('<p>'.$key.'</p><div class="outside"><ol>');
		foreach ($cats[$key] as $v) echo '<li>'.$v.'</li>';
		echo ('</ol></div>');
	}
?>
					</p>
				</div>
			</div><div class="widecontent">
				<div class="section">
					<h2>Now debugging...</h2>
					<p>Request: `<?=$request?>`</p>
					<p>Parsed: `<?=$parsed?>`</p>
					<p>File: `<?=$file?>`</p>
					<p>RSide: `<?=$rside?>`</p>
				</div><div class="section">
					<h2>
						Section
					</h2><p>
						Section: <?=$section?>
					</p><p>
						Location: <?=$location?>
					</p>
				</div><div class="section">
					<h2>
						Options
					</h2><p>
						Debug <?=isset($opt['debug'])?'true':'false'?>
					</p><p>
						Dynamic <?=isset($opt['dynamic'])?'true':'false'?>
					</p><p>
						Bounce <?=isset($opt['bounce'])?'true':'false'?>
					</p><p>
						Complete <?=isset($opt['complete'])?'true':'false'?>
					</p><p>
						Download <?=isset($opt['download'])?'true':'false'?>
					</p>
			</div>
		</div>
