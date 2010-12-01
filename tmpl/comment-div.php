<?php if ($page['comms'] > 1) { ?>
						<div class="wide"><div class="darkbox"></div></div>
						
						<div class="content">
							<div class="clearbox">
								<div class="section">
									<h2>Commenti</h2>
<?php if (isset($page['id'])) $rows = $b->get_comm ($page['id']); ?>
									<p>I commenti di questa pagina sono <?php switch ($page['comms']) {
										case 1: echo ('proibiti'); break;
										case 2: echo ('chiusi'); break;
										case 3: echo ('aperti'); break;
									} ?>.</p>
									<p>Questa pagina ha <?=$b->rows()?> comment<?=$b->rows() == 1?'o':'i'?>.</p>
<?php if (isset($rows)) if ($rows) while ($row = mysql_fetch_array ($rows)) { ?>
									<h2 id="comm-<?=$row[comm]?>">#<?=$row['comm']?>: <?=$row['date']?>, `<?=$row['name']?>' ha <?=$row['res']?'risposto a #<a href="#comm'.$row['res'].'">'.$row['res'].'</a>':'detto'?>:</h2>
									<p><?=$row['content']?></p>
<?php } ?>
								</div>
							</div>
						</div>

						<div class="nav">
							<div class="clearbox">

								<div class="section">
									<h2>Opzioni</h2>
<?php if ($user['logged']) { ?>
									<p id="comm-add-alt" onmousedown="javascript: showOrHide('comm-add')">Aggiungi un commento</p>
									<div id="comm-add-div" style="display: none">
										<form action="<?=$uri?>" method="post">
											<fieldset>
												<legend>Commento</legend>
												<table><tr><td>
															<label for="comm-res">In risposta a</label>
														</td><td>
															<input type="text" id="comm-res" name="cres" value="" />
													</td></tr><tr><td>
															<label for="comm-content">Testo</label>
														</td><td>
															<input type="text" id="comm-content" name="ccontent" value="" />
												</td></tr></table>
											</fieldset><fieldset>
												<legend>Opzioni</legend>

												<input type="hidden" name="cauthor" value="<?=$user[name]?>" />
												<input type="hidden" name="cpage" value="<?=$page[id]?>" />
												<input type="hidden" name="action" value="comment" />

												<input class="lx-btn" type="submit" value="Invia" />
												<input class="cx-btn" type="button" value="Nascondi"
														onclick="javascript: showOrHide ('comm-add')" />
												<input class="rx-btn" type="reset" value="Cancella" />

											</fieldset>
										</form>
									</div>
<?php } else { ?>
									<p>Per commentare questa pagina, devi prima loggarti.</p>
<?php } ?>
								</div>
							</div>
						</div>
<?php } ?>
