<?php

class offer
{
	public function calc_offer($o_id, $price)
	{
		$db = new database();
		
		$o_type = $db->get_var_query("select o_type from offer where o_id = $o_id");
		$o_per = $db->get_var_query("select o_per from offer where o_id = $o_id");
		if ($o_type == "درصد") {
			return (int)(($price * $o_per) / 100);
		} else {
			return (int)$o_per;
		}
		return $o_id;
	}
}