<!DOCTYPE html>
<html lang="it">
	<head>
		<!-- All your --><base href="http://<?=$_SERVER['SERVER_NAME']?>/" /><!-- are belong to us -->	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author"
			content="drachlyznardh &lt;drachlyznardh@roundhousecode.com &gt;" />
		<meta name="keywords" content="<?=$attr['keywords']?>" />
		<title><?=$attr['title']?></title>
		<link rel="stylesheet" type="text/css" href="sys/style/<?=($attr['gray']?'gray':'white')?>.css" />
		<link rel="stylesheet" type="text/css" href="sys/style/voices.css" />
		<link rel="stylesheet" type="text/css" href="sys/style/common.css" />
		<link rel="shortcut icon" type="image/x-icon" href="sys/style/ico/<?=($attr['gray']?'gray':'white')?>.ico" />
	</head>
	<!-- $Request[Original] = [<?=$request['original']?>] -->
	<!-- $Attr[Gray] = [<?=$attr['gray']?>], $Attr[Single] = [<?=$attr['single']?>] -->
	<!-- $Attr[Included] = [<?=$attr['included']?>] -->
	<!-- $Attr[Part] = [<?=$attr['part']?>], $Attr[Force_All_Tabs] = [<?=$attr['force_all_tabs']?>] -->
	<!-- $Request[Path] = [<?php
		$other=false;
		foreach ($request['path'] as $key)
			if ($other) { echo"; $key"; }
			else { $other=true; echo"$key"; }
	?>] -->
	<!-- $Search[Dir] = [<?=$search['dir']?>], $Search[File] = [<?=$search['file']?>], $Search[Include] = [<?=$search['include']?>] -->
	<body>
		<div id="main">
			<div id="content">
				<div id="head">
					<!-- Require_once("Sys/Fragment/Head") -->
					<?php require_once("sys/fragments/head.php"); ?>
				</div> <!-- Head -->
				<div id="core">
					<!-- Require_once("Sys/Fragment/Check") -->
					<?php require_once('sys/fragments/check.php'); ?>
