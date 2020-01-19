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
	$pa->add_payment($p_id, $pa_price, $pa_details, $pa_type);
}