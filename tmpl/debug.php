		<div class="section">
			<p>
				Debug! Debug infos everywhere!!!
			</p>
		</div><div class="wider">
			<div class="widelist">
				<div class="section">
					<h2>
						Sources
					</h2>
					<?=$finder->show()?>
				</div>
			</div><div class="widecontent">
				<div class="section">
					<h2>Now debugging...</h2>
					<p>Request: `<?=$request?>`</p>
					<p>Include: <?=$include?></p>
					<p>RSide: `<?=$rside?>`</p>
				</div><div class="section">
					<h2>
						Search
					</h2><p>
						<span class="em">Category</span>: <?php
							foreach ($search['category'] as $category)
								echo ($category .' / ');
						?>
					</p><p>
						<span class="em">Last</span> [<?=$search['last']?>]
					</p><p>
						<span class="em">Self</span> [<?=$self?>]
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
					</p><p>
						(a)Mode <?=$amode?>
					</p>
			</div><div class="section">
				<h2>
					Mode
				</h2><p>
					Mode is <?=$amode?>.
				</p>
			</div>
		</div>
