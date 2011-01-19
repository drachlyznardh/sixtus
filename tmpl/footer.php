	<div class="inside"><p>
		Il codice sorgente di questa pagina &egrave; valido secondo gli
		standard del <a href="http://www.w3.org">w3c</a>.
	</p></div><div class="outside"><p style="text-align: right">
		Se non
		visualizzi bene i contenuti, la colpa &egrave; necessariamente
		tua: procurati un <a href="http://www.mozilla.com">vero
		browser</a>.
	</p></div>
</div>
<!--div class="section"-->
	<div class="prev">
	<div class="section">
		<div class="inside">
			<p>
				If you love to sail the sea
			</p>
		</div><p style="text-align: center" onmousedown="javascript:cascade('secret')">
			You are a Pirate.
		</p><div class="outside">
			<p title="dice il nonno: &laquo;Fate i bravi, guidate piano&raquo;" style="text-align: right">
				Dis 'l nono: &laquo;Fe' i bravi, ne' pian&raquo;
			</p>
		</div>
	</div>
	</div><div class="top">
	<div class="section">
		<div class="inside">
			<p>
				<a href="http://validator.w3.org/check?uri=<?=$m->thispage()?>">HTML Valido</a>
			</p>
		</div><p style="text-align: center">
			<a href="http://users.skynet.be/mgueury/mozilla/">HTML5 Valido</a>
		</p><div class="outside">
			<p style="text-align: right">
				<a href="http://jigsaw.w3.org/css-validator/validator?uri=<?=$m->thisstyle()?>">CSS Valido</a>
			</p>
		</div>
	</div>
	</div><div class="next">
	<div class="section">
		<div class="inside">
			<p>
				Roses are <span style="font-family:monospace; color:#ff0000" title="red">#FF0000</span>
			</p>
		</div><p style="text-align: center">
			Violets are <span style="font-family:monospace; color:#0000ff" title="blue">#0000FF</span>
		</p><div class="outside">
			<p title="All my base are belong to &lt;please insert beautiful girl's name here&gt;" style="text-align: right">
				4ll my b4s3 r b3long 2 U
			</p>
		</div>
	</div>
	</div>
<div id="longsecret" style="display: none">
<?php if (isset($_SESSION['login']) && $_SESSION['login']) { ?>
	<div class="section"><p style="text-align: center">Welcome</p></div>
	<div class="prev">
		<div class="section">
			<h2>You are logged in</h2>
			<p>As &ldquo;<?=$_SESSION['name']?>&rdquo;</p>
			<p><?=print_r($_SESSION)?></p>
		</div>
	</div><div class="top">
		<div class="section">
			<h2>Log Out</h2>
			<form id="logoutform" action="#" method="post" style="display: none">
				<input type="hidden" name="action" value="logout" />
			</form><p>
				Click <a onmousedown="javascript:document.getElementById('logoutform').submit()">here</a> to Log Out.
			</p>
		</div>
	</div><div class="next">
		<div class="section">
			<h2 onmousedown="javascript:confirmdelete()">Delete</h2>
			<div class="outside"><form id="deleteform" action="#" method="post">
				<input id="deletefile" name="delete" type="text" />
				<input type="hidden" name="action" value="delete" />
				<input onclick="javascript:confirmdelete()" type="submit" value="delete" />
			</form></div>
		</div>
	</div>
<?php } else { ?>
	<div class="section"><p style="text-align:center">You found a secret!</p></div>
	<form action="#" method="post">
		<div class="prev">
			<div class="section">
				<h2>Name</h2>
				<div class="outside">
					<input id="secretname" name="name" type="text" />
				</div>
			</div>
		</div><div class="top">
			<div class="section">
				<h2>Password</h2>
				<div class="outside">
					<input id="secretpass" name="pass" type="password">
				</div>
			</div>
		</div><div class="next">
			<div class="section">
				<h2>Submit</h2>
				<div class="outside">
					<input type="hidden" name="action" value="login" />
					<input type="submit" value="Log In" />
				</div>
			</div>
		</div>
	</form>
<?php } ?>
</div>
<!--/div-->
<div class="section">
	<div class="inside"><p>
		Questa pagina è spinta da
			<a href="http://www.w3schools.com/php/default.asp">
			<abbr title="PHP Hypertext Preprocessor">PHP</abbr>
			</a>,
			<a href="http://www.w3schools.com/js/default.asp"
			title="THE scripting language for the Web">Javascript</a>
		e bestemmie.
	</p></div><p style="text-align: center">
		Le versione 0.7.3 di questa baracca è stata
		scritta con VIm. Copyright &copy; 2007&ndash;2011 Ivan Simonini.
	</p><div class="outside"><p style="text-align: right">
		Tutto questo &egrave; opera mia, pertanto ogni merito e colpa
		sono miei.
	</p></div>
