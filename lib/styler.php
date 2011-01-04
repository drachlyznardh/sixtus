<?php

	class Styler {
	
		public function ilink ($data, $second=false, $third=false) {
		
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
	}

?>
