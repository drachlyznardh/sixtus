<!DOCTYPE HTML>
<html lang="it">
	<head>
		<!-- All your --> <base href="/" /> <!-- are belong to us -->
	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="author" content="drachlyznardh &lt;drachlyznardh@roundhousecode.com &gt;" />
		<meta name="keywords" content="<?php foreach (explode('/', $self) as $keyword) echo ' '.$keyword; ?>" />
		<link rel="alternate" type="application/rss+xml" title="gods.roundhousecode.com/News" href="feed.rss.xml" />

		<title><?=$p->title()?></title>
		
		<link rel="stylesheet" type="text/css" href="style/common.css" />
		<link rel="stylesheet" type="text/css" href="style/coolstories.css" />
		<link rel="stylesheet" type="text/css" href="style/<?=$opt['style']?>.css" />
		<link rel="shortcut icon" type="image/x-icon" href="style/ico/<?=$opt['style']?>.ico" />
	</head>
	<body> 
		<div id="main">
			<div id="container">
				<div id="head">
					<div class="section">
						<div class="inside em"><p style="text-align:center">
							<a href="http://gods.roundhousecode.com">Gods</a>
							. <a href="http://roundhousecode.com">RoundhouseCode</a>
							. <a href="http://roundhousecode.com">com</a>
							<?php
								$sum = false;
								foreach ($search['category'] as $category) {
									$sum .= $category .'/';
									echo (' / '.$d->link($sum, $category));
								}
								if ($last != 'index') {
									echo (' / ');
									echo $d->link($self, strtoupper($pagename), false);
								}
								if ($tab['name']) {
									echo (' § ');
									echo $d->link($tab['req'].strtoupper($tab['name']).'/', strtoupper($tab['name']), 0);
								}
							?>
							/
						</p></div><h1 style="text-align:center">
							<?=$p->title()?>
						</h1><div class="outside em"><p style="text-align: center">
								<?=$p->subtitle()?>	
						</p></div>
					</div>
				</div><div id="content">
					<?php
						if (isset($opt['debug'])) require_once('tmpl/debug.php');

						if (function_exists('mkpage')) mkpage($d);
						$p->mkpages($d);
					?>
				</div> <!-- Content -->
				<div id="foot"><?php require_once ('tmpl/footer.php'); ?></div> <!-- Foot -->
			</div> <!-- Container -->
			<div id="rightside"><?php
				require_once ('tmpl/related.php');
				echo ('<br />');
				$p->mksides($d);
				echo ('<br />');
				if ($rside && file_exists($rside)) require_once ($rside);
			?></div> <!-- RightSide -->
			<div id="leftside"><?php require_once ('tmpl/lside.php'); ?></div> <!-- LeftSide -->
		</div> <!-- Main -->
	</body> <!-- Body -->
</html>
