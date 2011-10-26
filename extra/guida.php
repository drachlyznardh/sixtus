<?php
	$title=array('Guida','Perché la gente arriva ma non sa dov&apos;è la roba');
	function mkpage($d){
		$self='Extra/Guida/';
?>
<div class="wider">
	<div class="widelist">
		<div class="section">
			<p id="li-intro">
				<?=$d->link($self,'Intro','Intro')?>
			</p><h2 class="reverse">
				Guida
			</h2><p id="li-storie">
				<?=$d->link($self,'Storie','Storie')?>
			</p><p id="li-recensioni">
				<?=$d->link($self,'Recensioni','Recensioni')?>
			</p><p id="li-filmbrutti">
				<?=$d->link($self,'Film brutti','FilmBrutti')?>
			</p><p id="li-mini">
				<?=$d->link($self,'Mini','Mini')?>
			</p><p id="li-extra">
				<?=$d->link($self,'Extra','Extra')?>
			</p>
		</div>
	</div><div class="widecontent">
		<div class="tab" id="tab-intro">
			<div class="section">
	<p>
		Questa è la paginetta che ti spiega le cose.
	</p><p>
		Perché, mi rendo conto, non tutti sanno dove cercare le cose. Non tutti
		cercano le cose dove io le metto. Sarà colpa mia?
	</p><p>
		Per venirvi incontro ho aggiunto questo pezzetto. È ancora in
		progressione, quindi se vedete dei link che non sono clickabili,
		sappiate che non intendo preparare tutto in anticipo. Specialmente se mi
		sta leggendo il <span class="bolo">Bolo</span>.
	</p>
			</div>
		</div><div class="tab" id="tab-storie">
			<div class="section">
	<p>
		Le storie sono il vero cuore della baracca.
	</p><p>
		Si cominciò un po' di tempo fa, mi par che fosse attorno al settembre
		2010. Prima di quello, io e i miei allegri compagni, il <span
		class="em">popolo dell'aula studio</span>, tenevamo le storie per
		tradizione orale, come facevano gli antichi.
	</p><h2>
		Storie
	</h2><p>
		Da allora, ho sbrodolato una crescente e sorprendente quantità di
		storie. A volte sono semplicemente stupide, a volte invece raccontano
		pezzi di vita vissuta, a volte invece sono lo sfogo per le emozioni che
		non riesco a tenermi dentro, ma di cui non voglio parlare.
	</p><p>
		Perché scrivere è più comodo.
	</p>
			</div>
		</div><div class="tab" id="tab-recensioni">
			<div class="section">
	<h2>
		Recensioni
	</h2><p>
		Perché, se all'inizio raccontavo soltanto delle cose, un giorno ho
		finito per scrivere una storia immensamente lunga che in pratica
		recensiva (nel mio personale e peculiare stile) un certo
		<?=$d->link('Storie/2011/XXXVIII/','anime')?>.
	</p><p>
		Da quel punto in poi ho deciso che forse sarebbe stato il caso di
		riservare uno spazio dedicato a cose come quella. E poi ho cominciato.
	</p>
			</div>
		</div><div class="tab" id="tab-filmbrutti">
			<div class="section">
	<h2>
		Film brutti
	</h2><p>
		La parte dei film brutti, invece, è ancora un abbozzo… non sono sicuro
		che sia il caso che la gente sappia.
	</p><p>
		L'arte dei film brutti è una cosa rara e raffinata. Pochi li sanno fare,
		pochi li sanno apprezzare. E spesso non ho briga di scrivere…
	</p>
			</div>
		</div><div class="tab" id="tab-mini">
			<div class="section">
	<p>
		Le cosidette <span class="em">mini</span> sono le storielle troppo corte
		per meritare una storia intera.
	</p><p>
		Hanno cominciato a comparire nella pagina delle news nel settembre 2011.
		Le notizie, infatti, sono spesso accompagnate da un pezzetto di
		narrazione. A volte, invece, il pezzetto di narrazione è solitario.
	</p>
</div><div class="section">
	<h2>
		Mini
	</h2><p>
		Qualora dovessero diventare numerose oppure &lt;wooosh&gt; <span
		class="em">significative</span>, potrei anche metterle in una pagina o
		settore dedicato.
	</p>
			</div>
		</div><div class="tab" id="tab-extra">
			<div class="section">
	<p>
		Metasezione!!!
	</p><h2>
		Extra
	</h2><p>
		Questa sezione è appunto dedicata a questa sezione.
	</p>
</div><div class="section">
	<p>
		All'inizio (in realtà, fino a poco tempo fa, qualcosa come alcune
		settimane…) utilizzavo la sezione ‘extra’ soltanto come luogo in cui
		mettere tutte le immagini che compaiono sul sito; al tempo, erano tre.
	</p><p>
		Poi, con il passare del tempo, quelle immagini sono invecchiate, si sono
		coperte di polvere e da quella polvere è germinata della muffa, che alla
		fine, evolutasi fino allo stato di creatura senziente, è divenuta questa
		pagina che state leggendo.
	</p>
			</div>
		</div>
	</div>
</div>
<?php } ?>
