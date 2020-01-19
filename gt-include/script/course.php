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

if(isset($_POST['get_course_price'])) {
    $db = new database();
	$c_id = $_POST['c_id'];
    $c_fee = $db->get_var_query("select c_fee from course where c_id = $c_id");
    if($c_fee > 0) {
		echo $c_fee;
	} else {
		echo "error";
	}
	exit();
}