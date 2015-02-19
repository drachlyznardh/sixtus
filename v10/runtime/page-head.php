<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		<meta name="author" content="drachlyznardh &lt;drachlyznardh@gmail.com &gt;" />

		<link rel="icon" href="/sixtus/icon.ico" />
		<link rel="stylesheet" href="/sixtus/style.css" />
		<script src="/sixtus/panel.js"></script>

		<title>Siχtus MOBILE</title>
	</head><body>
		<div id="content" onclick="hide_all_sides();">
			<div id="header">

				<div id="location"><p>/ <?php require_once($sixtus.'host.php');
				printf('<a href="/">%s</a>', $host);
				?> / <?php $dest='/'; foreach ($d[0] as $w) { $dest.=$w.'/';
				printf('<a href="%s">%s</a> / ', $dest, $w); } ?></p></div>
				<div id="maintitle"><h1><?=$d[1]?></h1></div>
				<div id="subtitle"><p><?=$d[2]?></p></div>

			</div><div class="content">
