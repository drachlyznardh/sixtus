
<!--
	This file is a fragment for gods.roundhousecode.com
-->

<!-- Sys/Fragments/Left-Side [Start] -->
<div>
<div class="section">
	<h3>
		<a href="News/">Ultime</a> Novità
	</h3>
	<p  class="reverse">
		<a href="News/Archivio/">Archivio</a>
		/
		<a href="About/">About</a>
		/
		<a href="Extra/">Extra</a>
	</p>
</div>
<br />
<div class="section">
	<h2 class="reverse">Cose interessanti</h2>
	<h3>
		<a href="Storie/">Storie</a>
	</h3>
	<p  class="reverse">
		[ <a href="Diario/#">Diario</a> ]
		[ <a href="Storie/2010/#">2010</a>
		~<a href="Storie/2011/#">11</a>
		~<a href="Storie/2012/#">12</a>
		~<a href="Storie/2013/#">13</a> ]
	</p>
	<h3>
		<a href="Recensioni/">Recensioni</a>
	</h3>
	<p  class="reverse">
		<a href="Recensioni§CATEGORIE/">Categorie</a> /
		<a href="Recensioni§CLASSIFICA/">Classifica</a> /
		<a href="Recensioni§INDICE/">Indice</a>
	</p>
</div>
<div class="section">
	<h2 class="reverse">Cose meno interessanti</h2>
	<h3>
		<a href="Tru/Naluten/">Tru Naluten</a>
	</h3>
	<p  class="reverse">
		<a href="Tru/Naluten/Personaggi/">Personaggi</a> [
		<a href="Tru/Naluten/Vol.I/">Vol.I</a> /
		<a href="Tru/Naluten/Vol.II/">Vol.II</a> /
		<a href="Tru/Naluten/Vol.III/">Vol.III</a> ]
	</p>
	<h3>
		<a href="NaNoWriMo/">NaNoWriMo</a>
	</h3>
	<p  class="reverse">
		<a href="NaNoWriMo/2010/">2010</a> /
		<a href="NaNoWriMo/Corvino/Multicolore/">Corvino Multicolore</a> /
		<a href="NaNoWriMo/2011/">2011</a>
	</p>
	<h3>
		<a href="Legend/">Legend</a> RPG
	</h3>
	<p  class="reverse">
		<a href="Legend/">Regolamento</a>
		/ Cronache [
		<a href="Legend/Cronache/I">GODS</a>
		/
		<a href="Legend/Cronache/II/">War</a>
		]
	</p>
</div>
<div class="section">
	<div class="inside">
		<p>
			<a href="Extra/Guida§META/#Modi">Modi</a>
			[
			<em>Gods</em>
			|
			<a href="News/Raw/Bolo/">Bolo</a>
			/
			<a href="News/Raw/Luber/">Luber</a>
			]
			<a href="Extra/Guida§META/#Modi">?</a>
		</p>
	</div>
	<div class="outside">
		<p  class="reverse">
			<a href="Extra/Guida§META/#Stili">?</a>
			[
			<em>Raw</em> | <a href="News/Gods/Dado/">Dado</a>
			]
			<a href="Extra/Guida§META/#Stili">Stili</a>
		</p>
	</div>
</div>
<div class="section">
	<div style="width:50%; float:left"><div class="inside">
			<p style="text-indent:0">
				Tab [ <?php
	if ($attr['single']) {
		echo ('<em>Single</em>');
	} else {
		$custom = array('single' => true, 'gray' => $attr['gray']);
		$url = make_canonical($custom, $attr['self'], $request['tab']);
		echo ('<a href="'.$url.'">Single</a>');
	}
				?> | <?php
	if ($attr['single']) {
		$custom = array('single' => false, 'gray' => $attr['gray']);
		$url = make_canonical($custom, $attr['self'], $request['tab']);
		echo ('<a href="'.$url.'">All</a>');
	} else {
		echo('<em>All</em>');
	}
				?> ]
			</p>
	</div></div>
	<div style="width:50%; float:right"><div class="outside">
			<p class="reverse" style="text-indent:0">
				[ <?php
	if ($attr['gray']) {
		echo ('<em>Gray</em>');
	} else {
		$custom = array('single' => $attr['single'], 'gray' => true);
		$url = make_canonical($custom, $attr['self'], $request['tab']);
		echo ('<a href="'.$url.'">Gray</a>');
	}
				?> | <?php
	if ($attr['gray']) {
		$custom = array('single' => $attr['single'], 'gray' => false);
		$url = make_canonical($custom, $attr['self'], $request['tab']);
		echo ('<a href="'.$url.'">White</a>');
	} else {
		echo ('<em>White</em>');
	}
				?> ] Theme
			</p>
	</div></div>
	<div style="float:none; clear:both"></div>
</div>
<br />
<div class="section">
	<h2><span class="em" title="“Un po&apos; culattoni?” “No, no, solo allegri”">Allegri</span> compagni</h2>
	<p>
		Le <a href="http://kiyuko.org/blog/">idee</a> del <span
		class="bolo">Bolo</span>, le <a
		href="http://dacav.roundhousecode.com/">seghe</a> di <span
		class="dacav">Simgi Dacav</span>, le <a
		href="http://mikezasch.wordpress.com/">lamentele</a> di <span
		class="mitch">Mitch</span>, le <a
		href="http://jazzinghen.wordpress.com/">opinioni</a> di <span
		class="jazz">Jazzinghen</span> e le <em>nuove</em> <a
		href="https://plus.google.com/communities/117214031469177046669">cose fighe</a> del <em>Barone</em>.
	</p>
</div>
</div>
<!-- Sys/Fragments/Left-Side [Stop] -->

