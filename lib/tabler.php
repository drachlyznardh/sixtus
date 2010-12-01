<?php

	class Tabler {
	
		public $baser;
		
		public function __construct ($baser) {
		
			$this->baser = $baser;
		}
		
		public function drawTable ($key, $fields, $table) {
		
			$result = $this->baser->ask ('select * from `'. $table .'` order by `'. $key .'`') or die ($this->baser->error ());
			$row = mysql_fetch_assoc ($result);

			$index = 0;
			$jndex = 0;
			
			while ($row) {
			
				$rows[$jndex][$index] = $row;

				$index = ($index + 1) % 10;
				if ($index  == 0) $jndex++;
				
				$row = mysql_fetch_assoc ($result);
			}
			
			$index = 0;
			$jndex = 0;

			if ($rows) foreach ($rows as $group) {
			
				$this->drawHeader ($table, $jndex, $jndex + count($group) - 1, $fields);
				foreach ($group as $row) {
					$this->drawLine ($index, $key, $fields, $row, $index % 2);
					$index++;
				}
				$this->drawFooter ();
				$jndex += 10;

			} else $this->noLines ($table);
		}
		
		public function drawLine ($index, $key, $fields, $row, $dark) {
		
			$jndex = 0;
			
			echo ('<tr');
			if ($dark) echo (' class="dark"');
			echo ('>');
			
			foreach ($fields as $field) {
				$this->drawCell ($jndex, $index, $key, $field, $row);
				$jndex++;
			}

			$this->drawRemove ($row[$key], $index);
			echo ("\n\t\t\t\t\t\t\t\t</tr>");
		}
		
		public function drawHeader ($table, $first, $last, $fields) { ?>
						<h2 style="cursor: pointer"
								onmousedown="javascript: showOrHide ('table-<?=$first?>')"><?=ucwords($table)?>, righe <?=$first?> &ndash; <?=$last?></h2>
						<div id="table-<?=$first?>-div">
							<table>
								<tr class="dark">
									<?php foreach ($fields as $field) { ?><th><?=$field?></th><?php } ?>
									<th>Rimuovi</th>
								</tr>
		<?php }
		
		public function drawFooter () { ?>
							</table>
						</div>
		<?php }
		
		public function drawCell ($jndex, $index, $key, $field, $row) { ?>
		
									<td id="c<?=$jndex?>-<?=$index?>">
										<p onmousedown="javascript:setFormData('<?=$field?>','<?=htmlentities($row[$field])?>','<?=$row[$key]?>')"
												style="text-indent: 0px; text-align: center" title="<?=$row[$field]?>"><?=$row[$field]?$row[$field]:'[empty]'?></p>
									</td>
		<?php }
		
		public function drawRemove ($id, $i) { ?>
									<td id="remove-<?=$i?>">
										<p onmousedown="javascript: checkRemove (<?=$id?>)"
												style="text-indent: 0px; text-align: center">Rimuovi</p>
									</td>
		<?php }
		
		public function noLines ($table) { ?>
							<h2><?=ucwords($table)?></h2>
							<p>Nessun dato presente.</p>
		<?php }
		
	}

?>
