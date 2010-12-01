<?php

	class Baser {
	
		public $host    = null;
		public $db      = null;
		public $name    = null;
		public $pass    = null;
		public $connect = null;
		
		public $last    = null;
		public $result  = null;

		public function __construct ($host, $db, $name, $pass) {

			$this->host = $host;
			$this->name = $name;
			$this->pass = $pass;
		
			$this->connect = mysql_connect ($host, $name, $pass) or die (mysql_error ());
			$this->db = $db;
			mysql_select_db ($this->db, $this->connect) or die (mysql_error ());
		}
		
		public function close () { mysql_close (); }
		
		public function ask ($query) {
		
			$this->last = $query;
			$this->result = mysql_query ($query, $this->connect);
		
			return $this->result;
		}
		
		public function page_data ($request) {
		
			$query = "select * from `$this->db`.`pages` natural join `$this->db`.`requests` natural join `$this->db`.`links` natural join `$this->db`.`needs` where `request` like '$request'";
			$result =  $this->ask ($query);
			$lines = mysql_num_rows ($result);
			
			if ($lines > 0) $result = mysql_fetch_assoc ($result);
			else $result = false;

			return $result;
		}

		public function page_short ($page) {
		
			$query = "select `title`, `request` from `$this->db`.`pages` natural join `$this->db`.`requests` where `page` = $page";
			return $this->ask ($query);
		}
		
		public function get_comm ($page) {
		
			$query = "select * from `$this->db`.`comms` natural join `$this->db`.`users` where `page` = $page order by `comm`";
			return $this->ask ($query);
		}

		public function get_user ($username) {
		
			$query = "select * from `$this->db`.`users` where `name` = '$username'";
			return $this->ask ($query);
		}

		public function rows () { if ($this->result) return mysql_num_rows ($this->result); else return 0; }

		public function error () {
			
			if (mysql_num_rows ($this->result))
				return '<p>' . $this->last . ': ' . mysql_error () . '</p>';
			else
				return '<p>No results from ' . $this->last . '</p>';
		}
	}

?>
