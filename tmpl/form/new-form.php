						<h2 onmousedown="javascript: showOrHide ('new')" style="cursor: pointer"><?=$new['title']?></h2>
						<div id="new-div">
							<form class="big" action="<?=$uri?>" method="post">
								<fieldset>
									<legend><?=$new['legend']?></legend>
									<table><tr><td>
											<label for="new-<?=$new['name']?>"><?=$new['label']?></label>
										</td><td>
											<input id="new-<?=$new['name']?>" name="new-input" type="text" />
									</td></tr></table>
								</fieldset><fieldset>
									<legend>Opzioni</legend>
									<input type="hidden" name="action" value="new" />
									<input type="hidden" name="new-table" value="<?=$table?>" />
									<input type="hidden" name="new-key" value="<?=$key?>" />
									<input class="lx-btn" type="submit" value="Invia" />
									<input class="cx-btn" type="reset" value="Cancella" />
									<input class="rx-btn" type="button" value="Nascondi" onclick="javascript: showOrHide ('new')" />
								</fieldset>
							</form>
						</div>

