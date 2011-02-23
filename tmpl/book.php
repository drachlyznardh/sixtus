<!DOCTYPE HTML>
<html lang="it">
	<head>
		<!-- All your --> <base href="http://localhost/faiv/book/World/Of/The/Gods/" /> <!-- are belong to us -->
	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author" content="drachlyznardh &lt;drachlyznardh@roundhousecode.com&gt;" />
		<meta name="keywords" content="<?=$section.$file.' '.$title?>" />
		<link rel="alternate" type="application/rss+xml" title="TruNaluten - News" href="rss.xml" />

		<title><?=$title?></title>
		
		<link rel="stylesheet" type="text/css" href="http://localhost/faiv/style/book.css" />
		<script type="text/javascript" src="http://localhost/faiv/lib/scr.js"></script>

		<link rel="shortcut icon" type="image/x-icon" href="http://localhost/faiv/style/ico/raw.ico" />
		
	</head>
	<body>

		<div id="main">
			<div id="container" class="scrollable">
				<div class="clearbox">

<?php
	if (isset($opt['debug'])) require_once('tmpl/debug.php');
	mkpage($d);
?>
						
				</div> <!-- Clear Box -->
			</div> <!-- Content -->
			<div id="side" class="scrollable">
				<div class="clearbox">

<?php
	mkindex($d);
	require_once ('world/index.php');
?>
				</div>
			</div> <!-- Side -->
		</div> <!-- Main -->
	</body> <!-- Body -->
</html>
