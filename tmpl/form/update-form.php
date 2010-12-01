								<h2 onmousedown="javascript: showOrHide ('update')" style="cursor: pointer">Modifica</h2>
								<div id="update-div">
									<form class="big" action="<?=$uri?>" method="post">
										<fieldset>
											<legend id="update-legend">Dati della query</legend>
											<table class="ft"><tr><td>
														<label id="update-label" for="update-input">Campo</label>
													</td><td>
														<input type="text" id="update-input" name="update-input" value="Valore" />
											</td></tr></table>
										</fieldset><fieldset>
											<legend>Opzioni</legend>
											<input type="hidden" id="update-field" name="update-field" value="field" />
											<input type="hidden" id="update-id" name="update-id" value="id" />

											<input type="hidden" name="update-key" value="<?=$key?>" />
											<input type="hidden" name="update-table" value="<?=$table?>" />

											<input type="hidden" name="action" value="update-table" />

											<input class="lx-btn" type="submit" value="Invia" />
											<input class="cx-btn" type="reset" value="Cancella" />
											<input class="rx-btn" type="button" value="Cambia" onclick="javascript: showOrHide ('update')" />
										</fieldset>
									</form>
								</div>
								<div id="update-alt" style="display: none">
									<form class="big" action="<?=$uri?>" method="post">
										<fieldset>
											<legend>Dati della query</legend>
											<table class="ft"><tr><td>
														<label for="update-direct-field">Campo</label>
													</td><td>
														<input type="text" id="update-direct-field" name="update-field" value="" />
												</td></tr><tr><td>
														<label for="update-direct-input">Valore</label>
													</td><td>
														<input type="text" id="update-direct-input" name="update-input" value="" />
												</td></tr><tr><td>
														<label for="update-direct-id"><?=$key?></label>
													</td><td>
														<input type="text" id="update-direct-id" name="update-id" value="" />
											</td></tr></table>
										</fieldset><fieldset>
											<legend>Opzioni</legend>

											<input type="hidden" name="update-key" value="<?=$key?>" />
											<input type="hidden" name="update-table" value="<?=$table?>" />

											<input type="hidden" name="action" value="update-table" />

											<input class="lx-btn" type="submit" value="Invia" />
											<input class="cx-btn" type="reset" value="Cancella" />
											<input class="rx-btn" type="button" value="Cambia" onclick="javascript: showOrHide ('update')" />
										</fieldset>
									</form>
								</div>

