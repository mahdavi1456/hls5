<?php

class cost
{
	public function get_headlines_name($h_id) {
		$db = new database();
		$sql = "select h_name from headlines where h_id = $h_id";
		$h_name = $db->get_var_query($sql);
		if($h_name) {
			return $h_name;
		} else {
			return "";
		}
	}

}