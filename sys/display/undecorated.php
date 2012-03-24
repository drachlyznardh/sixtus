<!DOCTYPE HTML>
<html lang="it">
	<head>
		<!-- All your --> <base href="http://<?=$_SERVER['SERVER_NAME']?>/" /> <!-- are belong to us -->
	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author" content="drachlyznardh &lt;drachlyznardh@roundhousecode.com &gt;" />
		<meta name="keywords" content="<?php foreach (explode('/', $self) as $keyword) echo ' '.$keyword; ?>" />
		<link rel="alternate" type="application/rss+xml" title="gods.roundhousecode.com/News" href="feed.rss.xml" />

		<title><?=$p->gettitle()?></title>
		
		<link rel="stylesheet" type="text/css" href="style/common.css" />
		<link rel="stylesheet" type="text/css" href="style/coolstories.css" />
		<link rel="stylesheet" type="text/css" href="style/<?=$opt['style']?>.css" />
		<link rel="shortcut icon" type="image/x-icon" href="style/ico/<?=$opt['style']?>.ico" />
	</head>
	<body> 
		<div id="main">
			<div id="container">
				<div id="content" class="small">
					<?php
						if (isset($opt['debug'])) require_once('sys/debug.php');
						if ($d->allTab()||$p->allTabs()) echo ($p->getAllTabs(false));
						else echo ($p->getTab ($tab['name'], false));
					?>
				</div> <!-- Content -->
			</div> <!-- Container -->
		</div> <!-- Main -->
	</body> <!-- Body -->
</html>
