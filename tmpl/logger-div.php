<?php if ($user['logged']) { ?>
							<h2 style="cursor: pointer"
									onmousedown="javascript: showOrHide('logger-option')">Opzioni</h2>
							<div id="logger-option-div">
								<form id="logout-form" action="<?=$request?>" method="post" style="display: none">
									<fieldset>
										<legend>Hidden</legend>
										<input type="hidden" name="action" value="logout" />
									</fieldset>
								</form>
								<p><a onclick="javascript: document.getElementById('logout-form').submit()"
										style="cursor: pointer">Logout</a></p>
								<p><?=$s->ilink ('Tables/', 'Amministra')?></p>
							</div>
<?php } else { ?>
							<h2 style="cursor: pointer"
									onmousedown="javascript: showOrHide ('logger-login')">Login</h2>
							<div id="logger-login-div" style="display: none">
								<form action="<?=$request?>" method="post">
									<fieldset>
										<legend>Inserisci i tuoi dati</legend>
										<table class="ft"><tr><td>
													<label for="username">Username</label>
												</td><td>
													<input id="username" name="username" type="text" value="username" />
											</td></tr><tr><td>
													<label for="password">Password</label>
												</td><td>
													<input id="password" name="password" type="password" value="password" />
										</td></tr></table>
									</fieldset><fieldset>
										<legend>Azioni</legend>
										<input type="hidden" name="action" value="login" />
										<input class="lx-btn" type="submit" value="Login"/>
										<input class="cx-btn" type="button" value="Nascondi" onclick="javascript: showOrHide ('logger-login')" />
										<input class="rx-btn" type="reset" value="Cancella"/>
									</fieldset>
								</form>
							</div>
<?php } ?>
							<p>Questa <span title="<?=$request?>">pagina</span> è <?php switch ($page['permission']) { case 3: echo ('libera'); break; case 2: echo ('riservata'); break; case 1: echo ('protetta'); break;} ?>.</p>
