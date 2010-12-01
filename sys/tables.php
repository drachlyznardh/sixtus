							<h2 onmousedown="javascript: showOrHide ('direct')" style="cursor: pointer">Direct</h2>
								<div id="direct-div" style="display: none">
								<form action="<?=$uri?>" method="post">
									<fieldset>
										<legend>Query</legend>
										<table class="ft"><tr><td class="form_label">
													<label for="query">Query</label>
												</td><td class="from_input">
													<input type="text" id="query" name="query" value="Be careful" />
										</td></tr></table>
									</fieldset><fieldset>
										<legend>Opzioni</legend>

										<input type="hidden" name="action" value="direct" />

										<input class="lx-btn" type="submit" value="Invia" />
										<input class="rx-btn" type="reset" value="Cancella" />
										<input class="cx-btn" type="button" value="Nascondi"
												onclink="javascript: showOrHide ('direct')" />

									</fieldset>
								</form>
							</div>
						</div><div class="section">
							<h2 onmousedown="javascript: showOrHide ('tables')" style="cursor: pointer">Tabelle</h2>
							<div id="tables-div">
								<ul>
									<li><?$s->pilink('Tables/Page/', 'Pagine');?></li>
									<li><?$s->pilink('Tables/User/', 'Utenti');?></li>
									<li><?$s->pilink('Tables/Side/', 'Laterali');?></li>
								</ul>
							</div>

