<?php
	$title=array('Recensioni','Sincere, spesso brutte');
	function mkpage($d) {
		$self='Recensioni/';
?>
<div class="wider">
	<div class="widelist">
		<div class="section">
			<h2>
				Recensioni
			</h2><ol><li id="li-i">
					<?=$d->link($self,'Introduzione','I')?>
				</li><li id="li-ii">
					<?=$d->link($self,'Seconda Introduzione','II')?>
			</li></ol>
		</div><div class="section">
			<h2 class="reverse">
				Classifica
			</h2><ol start="3"><li id="li-iii">
					<?=$d->link($self,'Fucking awesome!!!','III')?>
				</li><li id="li-iv">
					<?=$d->link($self,'Buono','IV')?>
				</li><li id="li-v">
					<?=$d->link($self,'Si lascia guardare','V')?>
				</li><li id="li-vi">
					<?=$d->link($self,'Meh. / Mah','VI')?>
				</li><li id="li-vii">
					<?=$d->link($self,'L&apos;ha fatto Micheal Bay?','VII')?>
				</li><li id="li-viii">
					<?=$d->link($self,'No','VIII')?>
			</li></ol>
		</div>
	</div><div class="widecontent">
		<div class="tab" id="tab-i">
			<div class="section">
	<p>
		Non ne posso più, devo assolutamente sfogarmi.
	</p><p>
		Ma prima qualche parola per spiegare questa sezione.
	</p>
</div><div class="section">
	<p>
		Non a caso, quell'arguto professore ch'è War arrivò un giorno e mi
		disse:
	</p><div class="outside"><p>
			«Gods, è normale che non ci sia scritto niente, qui?»
	</p></div><p>
		Ed io risposì ch'era tutto come previsto.
	</p>
</div><div class="section">
	<p>
		Insomma, non è che una sezione appena nata meriti subito
		un'introduzione, no? Non necessariamente. Mettiamola così: era
		scrittura virale, come quelle pubblicità che non si capiscono
		affatto, ma dicono soltanto un nome...
	</p><p>
		Non che una pagina intitolata ‘Recensioni’ fosse 'sto gran
		mistero...
	</p><p>
		Comunque sia, ecco le mie
	</p><h2>
		Recensioni
	</h2><p>
		Perché come ho dimostrato <a href="Storie/2011/XXXVIII/">qui</a>, le
		storie non sono adatte a recensire... Ecco dunque uno spazio
		dedicato.
	</p>
</div><div class="section">
	<p>
		Dedicato quasi esclusivamente a recensioni negative, ovviamente.
		Come ci dimostrano amici come l'AVGN, quel tizio con gli occhiali e
		MovieBob, l'industria del cinema produce immense quantità di
		schifezza.
	</p><p>
		Ma non è solo colpa loro, e infatti non mi limiterò a recensire
		film, qui. Se ci sono cose di cui posso definirmi appassionato, ci
		sono anche i videogiochi, i Gundam, i Transformers e i fumetti.
	</p><p>
		Con il tempo, spalerò merda un po' su tutto.
	</p>
			</div>
		</div><div class="tab" id="tab-ii">
			<div class="section">
	<p>
		Ora che anche questa sezione comincia a riempirsi, è giunto il momento
		di spendere qualche altra parola…
	</p><p>
		All'inizio, infatti, questa non era una sezione ma soltanto una raccolta
		di cosucce. Lamentele, per la maggior parte. Ma con il tempo… o forse
		no.
	</p>
</div><div class="section">
	<p>
		Insomma, è vero che l'ho cominciata lamentandomi di
		<?=$d->link('Recensioni/Thor/','Thor')?>, ma poi ho recensito anche
		altre cose. Ed ho ancora smesso di creare un nuovo voto per ogni
		recensione.
	</p><p>
		Di fatto, ora che ho sei diversi livelli di valutazione mi sento
		abbastanza comodo. Un voto da 0 a 5 non è forse una buona cosa? Che
		direbbero gli analisti e gli statistici?
	</p><p>
		E comunque, sappiate che d'ora in poi m'impegno ad essere un po' più
		imparziale, un po' più seriamente critico. Le cose veramente orribili le
		metterò nella <?=$d->link('FilmBrutti/','sezione apposita')?>.
	</p>
			</div>
		</div><div class="tab" id="tab-iii">
			<div class="section">
	<h2>
		Fucking awesome!!!
	</h2><p>
		Questi sono decisamente da vedere/provare/comprare.
	</p><ul><li>
			<?=$d->link('Recensioni/AC-Brotherhood/','Assassin&apos;s Creed Brotherhood')?>
		</li><li>
			<?=$d->link('Recensioni/KamenRider/','Kamen Rider W','IV')?>
		</li><li>
			<?=$d->link('Recensioni/KamenRider/',
				'OOO, Den-O, all Riders: Let&apos; go Kamen Riders','M2011')?>
		</li><li>
			<?=$d->link('Recensioni/TransFormersPrime/',
				'Transformers: Prime','INTRO')?>
		</li></ul>
	</p>
			</div>
		</div><div class="tab" id="tab-iv">
			<div class="section">
	<h2>
		Buono
	</h2><p>
		Che ci crediate o meno, questi mi sono piaciuti. Non sono
		magnificissimi, non sono eccelsi, ma sono buoni.
	</p><ul><li>
			<?=$d->link('Recensioni/CapitanAmerica/','Capitan America')?>
		</li><li>
			<?=$d->link('Recensioni/AngelBeats/','Angel Beats!')?>
		</li><li>
			<?=$d->link('Recensioni/KamenRider/','Kamen Rider OOO', 'V')?>
	</li></ul>
			</div>
		</div><div class="tab" id="tab-v">
			<div class="section">
	<h2>
		Si lascia guardare
	</h2><p>
		Questi si lasciano guardare. Con le dovute precauzioni.
	</p><ul><li>
			<?=$d->link('Recensioni/Masterforce/','Masterforce')?>
		</li><li>
			<?=$d->link('Recensioni/IPuffi/','I Puffi')?>
		</li><li>
			<?=$d->link('Recensioni/NessunDove/','Nessun Dove')?>
	</li></ul>
			</div>
		</div><div class="tab" id="tab-vi">
			<div class="section">
	<h2>
		Meh. / Mah
	</h2><p>
		Questi non sono per tutti, sono per chi ha gusti particolari o lo
		stomaco di ferro.
	</p><ul><li>
			<?=$d->link('Recensioni/Robocop/','Robocop')?>
		</li><li>
			<?=$d->link('Recensioni/PaniPoniDash/','Pani Poni Dash')?>
		</li><li>
			<?=$d->link('Recensioni/HarryPotter/','Harry Potter')?>
			e <?=$d->link('Recensioni/HarryPotter/','La pietra filosofale','I')?>
			e <?=$d->link('Recensioni/HarryPotter/','La camera dei segreti','II')?>
			e <?=$d->link('Recensioni/HarryPotter/','Il prigioniero di
			Azkaban','III')?>
			e <?=$d->link('Recensioni/HarryPotter/','Il calice di fuoco','IV')?>
			e <?=$d->link('Recensioni/HarryPotter/','L&apos;ordine della Fenice','V')?>
	</li></ul>
			</div>
		</div><div class="tab" id="tab-vii">
			<div class="section">
	<h2>
		L'ha fatto Micheal Bay?
	</h2><p>
		Questi hanno il grosso difetto di mettere l'azione davanti alla storia.
		O semplicemente si dimenticano che le esplosioni non fanno un buon film
		/ buon anime / buona visione.
	</p><ul><li>
		<?=$d->link('Recensioni/Blassreiter/','Blassreiter');?>
	</li></ul>
			</div>
		</div><div class="tab" id="tab-viii">
			<div class="section">
	<h2>
		No
	</h2><p>
		Questi no.
	<p><ul><li>
			<?=$d->link('Recensioni/Thor/','Thor')?>
		</li><li>
			<?=$d->link('Recensioni/DarkOfTheMoon/','Dark Of The Moon')?>
		</li><li>
			<?=$d->link('Recensioni/GundamAGE/','Gundam AGE', 'INTRO')?>
	</li></ul>
			</div>
		</div>
	</div>
</div>
<?php } ?>
