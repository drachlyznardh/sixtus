<!DOCTYPE HTML>
<html lang="it">
	<head>
		<!-- All your --> <base href="<?=$loco->base?>/" /> <!-- are belong to us -->
	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author" content="drachlyznardh &lt;drachlyznardh@roundhousecode.com &gt;" />
		<meta name="keywords" content="<?=$m->thiskeyword()?>" />
		<link rel="alternate" type="application/rss+xml" title="TruNaluten - News" href="rss.xml" />

		<title><?=$m->page['title']?></title>
		
		<link rel="stylesheet" type="text/css" href="style/raw.css" />
		<link rel="stylesheet" type="text/css" href="style/voices.css" />
		<script type="text/javascript" src="lib/scr.js"></script>
		<script type="text/javascript">
document.onkeypress = myKeyUp;
function myKeyUp (e) {
	var key = (window.event) ? event.keyCode : e.keyCode;
	var div = document.getElementById('container');
	switch (key) {
	
		case 38: div.scrollTop -= 30; break;
		case 33: div.scrollTop -= 300; break;
		case 36: div.scrollTop = 0; break;
		case 40: div.scrollTop += 30; break;
		case 34: div.scrollTop += 300; break;
		case 35: div.scrollTop = 10000; break;
	}
}
		</script>

		<link rel="shortcut icon" type="image/x-icon" href="style/ico/raw.ico" />
		
	</head>
	<body>


		<div id="main">
			<div id="leftside" class="scrollable">
	
<?php require ($loco->mktmpl('side-div')); ?>
			</div> <!-- Side -->
			<div id="container" class="scrollable">
				<div id="head">
					<div class="clearbox">

						<div class="section">
							<h2 id="home">[
								<?=$m->nnk('','99k')?>
							|
								<?=$m->alter('', 'altervista')?>
							] 
								<?=$m->showPath()?>
							</h2>
							<h1 id="title"><?=$m->page['title']?></h1>
							<h2 id="subtitle"><?=$m->page['subtitle']?></h2>
						</div>

					</div> <!-- Clear Box -->
				</div> <!-- Head -->

				<div id="content">
					<div class="clearbox">

<?php if ($m->debug) $m->show();
	if (isset($m->prev)) {
?>
						<div class="section">
							<h2>Negli episodi precedenti</h2>
							<p>Questa serie continua dalla pagina precedente,
								<?=$m->ilink($m->prev)?>
							</p>
						</div>
<? }

	mkpage($d, $m);

	if (isset($m->next)) {
?>
						<div class="section">
							<h2>Continua...</h2>
							<p>Questa serie prosegue alla pagina successiva,
								<?=$m->ilink($m->next)?>
							</p>
						</div> <!-- Section -->
<?php } ?>
						
					</div> <!-- Clear Box -->
				</div> <!-- Content -->

				<div id="foot">
					<div class="clearbox">
						<div class="section">

<?php require_once ($loco->mktmpl('/footer-div')); ?>
						</div>
					</div> <!-- Clear Box -->
				</div> <!-- Foot -->
			</div>	
			<div id="rightside" class="scrollable">
				<div class="clearbox">
					<div class="section">

<?php require_once ($loco->mktmpl('/related')); ?>
<?php require_once ($m->thisside()); ?>
					</div> <!-- Section -->	
				</div> <!-- ClearBox -->
			</div> <!-- RightSide -->
		</div> <!-- Main -->
	</body> <!-- Body -->
</html>
