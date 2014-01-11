<?php

	function name_that_month($month)
	{
		switch($month % 12)
		{
			case  1: return 'Gennaio';   break;
			case  2: return 'Febbraio';  break;
			case  3: return 'Marzo';     break;
			case  4: return 'Aprile';    break;
			case  5: return 'Maggio';    break;
			case  6: return 'Giugno';    break;
			case  7: return 'Luglio';    break;
			case  8: return 'Agosto';    break;
			case  9: return 'Settembre'; break;
			case 10: return 'Ottobre';   break;
			case 11: return 'Novembre';  break;
			case  0: return 'Dicembre';  break;
		}
	}

	function scan_for_years ($keys, $current)
	{
		$limit = count($keys);
		$result = array(false, false);

		for ($i = 0; $i < $limit; $i++)
			if ($keys[$i] == $current)
			{
				$prev = $i - 1;
				$next = $i + 1;
				if (isset($keys[$prev])) $result[0] = $keys[$prev];
				if (isset($keys[$next])) $result[1] = $keys[$next];
				
				break;
			}

		return $result;
	}

	function dump_that_year ($year, $months)
	{
		$format = "link#Blog/%s/%s#%s";
		$slash = "\n\t\t/\n\t\t";
		
		for ($i = 0; $i < 4; $i++)
		{
			$result[] = "\tc#";

			$month = sprintf('%02d', $i * 3 + 1);
			if (array_search($month, $months) !== false)
				$result[] = sprintf($format,
					$year, $month, name_that_month($month));
			else $result[] = sprintf("%s", name_that_month($month));

			$result[] = $slash;

			$month = sprintf('%02d', $i * 3 + 2);
			if (array_search($month, $months) !== false)
				$result[] = sprintf($format,
					$year, $month, name_that_month($month));
			else $result[] = sprintf("%s", name_that_month($month));
		
			$result[] = $slash;

			$month = sprintf('%02d', $i * 3 + 3);
			if (array_search($month, $months) !== false)
				$result[] = sprintf($format,
					$year, $month, name_that_month($month));
			else $result[] = sprintf("%s", name_that_month($month));

			$result[] = "\n";
		}

		return implode($result);
	}

?>
