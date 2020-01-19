<?php
class payment
{
	
	public function add_payment($p_id, $pa_price, $pa_details, $pa_type)
	{
		$db = new database();
		
		$pa_date = jdate('Y/m/d H:i:s');
		$sql = "insert into payment(p_id, pa_price, pa_date, pa_details, pa_type) values($p_id, $pa_price, '$pa_date', '$pa_details', '$pa_type')";
		$db->ex_query($sql);
	}
	
}