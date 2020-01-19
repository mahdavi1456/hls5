<?php

class book
{
	public function get_book_name($b_id)
	{
		$db = new database();
		$b_name = $db->get_var_query("select b_name from book where b_id = $b_id");
		if($b_name) {
			return $b_name;
		} else {
			return "نامعتبر";
		}
	}

}