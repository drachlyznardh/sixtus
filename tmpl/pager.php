<!DOCTYPE HTML>
<html lang="it">
	<head>
		<!-- All your --> <base href="<?=$base?>/" /> <!-- are belong to us -->
	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author" content="drachlyznardh &lt;drachlyznardh@roundhousecode.com &gt;" />
		<meta name="keywords" content="Tru Naluten <?=isset($page['keyword'])?$page['keyword']:''?>" />
		<link rel="alternate" type="application/rss+xml" title="TruNaluten - News" href="rss.xml" />

		<title><?=$page['title']?></title>
		
		<link rel="stylesheet" type="text/css" href="style/raw.css" />
		<script type="text/javascript" src="lib/scr.js"></script>
<?php
	if (isset($master->source['scripts']))
		foreach ($master->source['scripts'] as $script)
			echo "\n\t\t" . '<script type="text/javascript" src="lib/'. $script .'"></script>';

	if (isset($master->source['styles']))
		foreach ($master->source['styles'] as $style)
			echo "\n\t\t" . '<link rel="stylesheet" type="text/css" href="style/'. $style .'" />';

?>

		<link rel="shortcut icon" type="image/x-icon" href="style/ico/raw.ico" />
		
	</head>
	<body>
		<div id="main">

			<div id="container">

<?php require ("$tmpl/container-div.php"); ?>
			</div> <!-- Container -->
			<div id="side">

<?php require ("$tmpl/side-div.php"); ?>
			</div> <!-- Side -->

		</div> <!-- Main -->
	</body> <!-- Body -->
</html>
