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

?>
