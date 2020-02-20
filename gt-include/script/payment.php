<?php
session_start();
require_once ("../lib/jdf.php");
require_once ("../class/database.php");
require_once ("../class/game.php");
require_once ("../class/person.php");
require_once ("../class/prime.php");
require_once ("../class/option.php");
require_once ("../class/gdate.php");
require_once ("../class/package.php");
require_once ("../class/price.php");
require_once ("../class/product.php");
require_once ("../class/factor.php");
require_once ("../class/adjective.php");
require_once ("../class/sms.php");
require_once ("../class/offer.php");
require_once ("../class/modal.php");
require_once ("../class/payment.php");

if(isset($_POST['add_payment'])) {
    $pa = new payment();
	$db = new database();
	
	$p_id = $_POST['p_id'];
	$pa_price = $_POST['pa_price'];
	$pa_details = $_POST['pa_details'];
	$pa_type = $_POST['pa_type'];
	$error_code = $_POST['error_code'];
	$rrn = $_POST['rrn'];
	$pa->add_payment($p_id, $pa_price, $pa_details, $pa_type, $error_code, $rrn);
}

if(isset($_POST['pos_payment'])) {
    $pa = new payment();
	$db = new database();
	$opt = new option();

	$samankish_terminal = $opt->get_option('samankish_terminal');

	if($samankish_terminal != "") {

		$curl = curl_init();
		curl_setopt_array($curl, array(
  			CURLOPT_URL => "http://91.240.180.189:8024/v1/PcPosTransaction/ReciveIdentifier",
  			CURLOPT_RETURNTRANSFER => true,
  			CURLOPT_ENCODING => "",
  			CURLOPT_MAXREDIRS => 10,
  			CURLOPT_TIMEOUT => 0,
  			CURLOPT_FOLLOWLOCATION => true,
  			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  			CURLOPT_CUSTOMREQUEST => "POST",
  			CURLOPT_POSTFIELDS =>"grant_type=password&username=test&password=password&scope=switchapimanagement offline_access",
  			CURLOPT_HTTPHEADER => array(
    			"Content-Type: application/x-www-form-urlencoded",
    			"Authorization: Basic cm8uY2xpZW50OnNlY3JldA=="
  			),
		));
		$response = curl_exec($curl);

		$Identifier = explode(':', $response)[5];
		$a = str_replace('"', "", $Identifier);
		$Identifier = str_replace('}', "", $a);

		$curl2 = curl_init();
		curl_setopt_array($curl2, array(
	  		CURLOPT_URL => "http://91.240.180.189:8024/v1/PcPosTransaction/StartPayment",
	  		CURLOPT_RETURNTRANSFER => true,
	  		CURLOPT_ENCODING => "",
	  		CURLOPT_MAXREDIRS => 10,
	  		CURLOPT_TIMEOUT => 0,
	  		CURLOPT_FOLLOWLOCATION => true,
	  		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  		CURLOPT_CUSTOMREQUEST => "POST",
	  		CURLOPT_POSTFIELDS =>"{\"TerminalID\":\"11899631\",\r\n\"Amount\":\"1000\",\r\n\"AccountType\":0,\r\n\"Additional\":\"test\",\r\n\"Identifier\":\"$Identifier\",\r\n\"TotalAmount\":\"1000\",\r\n\"userNotifiable\":{\"FooterMessage\":null,\r\n\"PrintItems\":[{\"Item\":\"Mohsen\",\r\n\"Value\":\"Moghadam\",\r\n\"Alignment\":0,\r\n\"ReceiptType\":2}]},\r\n\"TransactionType\":0,\r\n\"BillID\":null,\r\n\"PayID\":null,\r\n\"RefrenceData\":null}​",
	  		CURLOPT_HTTPHEADER => array(
	    		"Content-Type: application/json"
	  		),
		));

		$response2 = curl_exec($curl2);

		$error_code = $pa->get_error_code($response2);
		if($error_code == 0) {
			$rrn = $pa->get_rrn($response2);
		} else {
			$rrn = 0;  
		}
		return $error_code . "=" . $rrn;

		curl_close($curl2);
	}
}