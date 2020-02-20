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
	
	public function get_bank_name($ba_id) {
		$db = new database();
		$sql = $db->get_select_query("select * from bank_account where ba_id = $ba_id");
		if(count($sql) > 0){
			$ba_account_owner = $db->get_var_query("select ba_account_owner from bank_account where ba_id = $ba_id");  
			$ba_name = $db->get_var_query("select ba_name from bank_account where ba_id = $ba_id");  
			$ba_account_number = $db->get_var_query("select ba_account_number from bank_account where ba_id = $ba_id"); 
			$a = $ba_account_owner . " " . $ba_account_number . " " .$ba_name;
			return $a;
		} else {
			return "";
		}
	}

}