<?php
class payment
{
	
	public function add_payment($p_id, $pa_price, $pa_details, $pa_type)
	{
		$db = new database();
		$u_id = $_SESSION['user_id'];
		$pa_date = jdate('Y/m/d H:i:s');
		$sql = "insert into payment(p_id, pa_price, pa_date, pa_details, pa_type, u_id) values($p_id, $pa_price, '$pa_date', '$pa_details', '$pa_type', $u_id)";
		$db->ex_query($sql);
	}
	
}