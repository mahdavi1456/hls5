<?php
function get_theme_dir() {
	return "http://heliapp.ir/wood/";
}

function get_panel_dir() {
	return "http://heliapp.ir/";
}

function send_sms_super_admin($mobile, $msg){
	$url = "https://ippanel.com/services.jspd";
	$rcpt_nm = array($mobile);
	$param = array(
		'uname' => "mahdavi1456",
		'pass' => "m54692764o",
		'from' => "5000125475",
		'message' => $msg,
		'to' => json_encode($rcpt_nm),
		'op' => 'send'
	);				
	$handler = curl_init($url);
	curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($handler, CURLOPT_POSTFIELDS, $param);                       
	curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
	$response2 = curl_exec($handler);
			
	$response2 = json_decode($response2);
	$res_code = $response2[0];
	$res_data = $response2[1];
}