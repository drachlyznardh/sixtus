<?php
	$title=array('Film Brutti','Ne ho visti, quanti ne ho visti');
	function mkpage($d){
?>
<div class="wider">
	<div class="widelist">
		<div class="section">
			<h2>
				Film brutti
			</h2><ol><li id="li-i">
					<?=$d->link($d->self,'Introduzione','I')?>
			</li></ol><h2 class="reverse">
				Classifica
			</h2><ol start="2"><li id="li-ii">
					<?=$d->link($d->self,'Magnificamente brutto','II')?>
				</li><li id="li-iii">
					<?=$d->link($d->self,'Brutto da ridere','III')?>
				</li><li id="li-iv">
					<?=$d->link($d->self,'Soltanto brutto','IV')?>
			</li></ol>
		</div>
	</div><div class="widecontent">
		<div class="tab" id="tab-i">
			<div class="section">
	<p>
		'Nsomma, io che ho visto TUTTI i film di Godzilla, di film brutti ne
		so qualcosa. Non ne so quanto War, o quanto <a
		href="mecharete.blogspot.com">Luber</a>, ma ne so.
	</p><p>
		Quindi elencherò un po' di schifezze, così che non vi capiti di
		andarle a cercare o meglio, trovandole, sappiate evitarle.
	</p><p>
		Ma non tutto fa schifo schifo. Alcune cose, che spero di arrivare ad
		elencare, sono tanto brutte da far ridere, altre tanto brutte da
		diventare apprezzabili. Altre invece sono solo brutte.
	</p>
			</div>
		</div><div class="tab" id="tab-ii">
			<div class="section">
	<h2>
		Magnificamente brutto
	</h2><p>
		Insomma, l'ho detto e lo ripeto, alcuni film sono così brutti da fare il
		giro e diventare più che godibili.
	</p><p>
		Ne parlerò di più quando avrò tempo e briga. Intanto, andate a vedervi
		un po' di 'sta roba:
	</p><ul><li>
			Machete
		</li><li>
			Sharktopus
		</li><li>
			The Rocky Horror Picture Show
	</li></ul>
			</div>
		</div><div class="tab" id="tab-iii">
			<div class="section">
	<h2>
		Brutto da ridere
	</h2><p>
		Questi sono bruttarelli. Sono fatti male. Ma non con intenzione. Rido di
		loro, non con loro.
	</p><ul><li>
			Robot
		</li><li>
			Alien Vs Ninja
	</li></ul>
			</div>
		</div><div class="tab" id="tab-iv">
			<div class="section">
	<h2>
		Soltanto brutto
	</h2><p>
		Questi sono proprio brutti, fatti con pochi soldi, con poche idee. Non
		abbastanza brutti da piacere.
	</p><ul><li>
			D–Wars
		</li><li>
			Mega shark Vs Giant Octopus
		</li><li>
			<?=$d->link('FilmBrutti/BitchSlap/','Bitch Slap')?>
	</li></ul>
			</div>
		</div>
	</div>
</div>
<?php } ?>
