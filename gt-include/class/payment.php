<?php
class payment
{
	
	public function add_payment($p_id, $pa_price, $pa_details, $pa_type, $error_code, $rrn)
	{
		$db = new database();
		$u_id = $_SESSION['user_id'];
		$pa_date = jdate('Y/m/d H:i:s');
		$sql = "insert into payment(p_id, pa_price, pa_date, pa_details, pa_type, u_id, error_code, rrn) values($p_id, $pa_price, '$pa_date', '$pa_details', '$pa_type', $u_id, $error_code, $rrn)";
		$db->ex_query($sql);
	}

	public function remove_ez($str) {
		$a = str_replace('{', '', $str);
		$a = str_replace('}', '', $a);
		$a = str_replace('"', '', $a);
		return $a;
	}

	public function get_rrn($response) {
		$list = explode(",", $response);
		foreach($list as $l) {
			$r = $this->remove_ez($l);
			if($r_list = explode(':', $r)[0] == "RRN") {
				return explode(':', $r)[1] . "<hr>";
			}
		}
		return null;
	}

	public function get_error_code($response) {
		$list = explode(",", $response);
		foreach($list as $l) {
			$r = $this->remove_ez($l);
			if($r_list = explode(':', $r)[0] == "ErrorCode") {
				return explode(':', $r)[1] . "<hr>";
			}
		}
		return null;
	}
	
}