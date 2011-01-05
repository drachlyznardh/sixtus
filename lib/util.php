<?php

	function mkcascade($title, $name, $flag=true) {

		return '<h2 id="arrow'.$title.'" class="'.($flag?'closed':'opened').'" onmousedown="javascript:cascade(\''.$title.'\')">'.$name.'</h2>'."\n";
	}
	
	function ilink ($data, $second=false, $third=false) {
		
			if (is_array($data)) {

				$url = $data['request'];
				if (isset($data['sharp'])) $url = $url .'#'. $data['sharp'];
				$title = $data['title'];

			} else {
			
				$url = $data;
				$title = $second;
				if ($third) $url = $url .'#'. $third;
			}

			return '<a href="'. $url .'">'. $title .'</a>';
	}

	function nnk ($data, $second=false, $third=false) {
	
		if (is_array($data)) {
		
			$data['request'] = 'http://trunaluten.99k.org/'.$data['request'];
			return ($data);
		} else {
		
			return ilink('http://trunaluten.99k.org/'.$data, $second, $third);
		}

		return ilink ('');
	}

	function alter ($data, $second=false, $third=false) {
	
		if (is_array($data)) {
		
			$data['request'] = 'http://drachlyznardh.altervista.org/'.$data['request'];
			return ($data);
		} else {
		
			return ilink('http://drachlyznardh.altervista.org/'.$data, $second, $third);
		}

		return ilink ('');
	}

?>

