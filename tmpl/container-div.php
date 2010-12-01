				<div id="head">
					<div class="darkbox">

						<p id="home"><?=$s->pilink ('home/', 'home');?></p>
						<h1 id="title"><?=$page['title']?></h1>
						<p id="subtitle"><?=$page['subtitle']?></p>

					</div> <!-- Dark Box -->
				</div> <!-- Head -->

				<div class="content">
					<div class="clearbox">

						<div class="section">
						<?php if (isset($related['prev'])) { ?>
							<h2>Negli episodi precedenti</h2>
							<p>Questa serie continua dalla pagina precedente,
								<?php $s->pilink ($related['prev']['request'], $related['prev']['title']); ?>
							</p></div><div class="section">
						<? } ?>
						
						<?=mkpage()?>
						
						<?php if (isset($related['next'])) { ?>
							</div><div class="section">
							<h2>Continua...</h2>
							<p>Questa serie prosegue alla pagina successiva,
								<?php $s->pilink ($related['next']['request'], $related['next']['title']); ?>
							</p>
						<?php } ?>
						
						</div> <!-- Section -->
<?php if ((isset($related) && $related) || (isset ($page['side']) && $page['side'])) { ?>
					</div> <!-- Clear Box -->
				</div> <!-- Content -->

				<div class="nav">
					<div class="clearbox">
<?php } ?>
<?php if (isset($related['prev']) || isset($related['index']) || isset($related['next'])) { ?>
						<div class="section">
							<h2>Pagine collegate</h2>
							<?php if (isset($related['prev'])) { ?>
								<p>Precedente:
									<?php $s->pilink ($related['prev']['request'], $related['prev']['title']); ?>
								</p>
							<?php }
							if (isset($related['index'])) { ?>
								<p>Indice:
									<?php $s->pilink ($related['index']['request'], $related['index']['title']); ?>
								</p>
							<?php }
							if (isset($related['next'])) { ?>
								<p>Successivo:
									<?php $s->pilink ($related['next']['request'], $related['next']['title']); ?>
								</p>
							<?php } ?>
								<p><a href="<?=$request?>download/">Download</a></p>
						</div> <!-- Section -->
<?php } 
if ($page['side']) require_once ($sides .'/'. $page['side']); ?>
					</div> <!-- Clear Box -->
				</div> <!-- Nav -->
				
<?php require_once ($tmpl . '/comment-div.php'); ?>

				<div id="foot">
					<div class="darkbox">

<?php require_once ($tmpl . '/footer-div.php') ?>
					</div> <!-- Dark Box -->
				</div> <!-- Foot -->
