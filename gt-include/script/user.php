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

if(isset($_POST['set_activity'])) {
    $db = new database();
    
	$u_code = ltrim($_POST['u_code'], "0");
    $u_id = $db->get_var_query("select u_id from user where u_code = '$u_code'", 1);
    if($u_id == "") {
        echo "<br><div class='alert alert-danger'>این کارت معتبر نیست</div>";
    } else {
		$ua_date = jdate('Y/m/d');
		$ua_time = jdate('H:i:s');
		$res = $db->get_select_query("select * from user_activity where u_id = $u_id and ua_out_time = '00:00:00' order by ua_id desc limit 1");
		if(count($res) > 0) {
			$ua_id = $res[0]['ua_id'];
			$sql = "update user_activity set ua_out_time = '$ua_time' where ua_id = $ua_id";
		} else {
			$sql = "insert into user_activity(u_id, ua_date, ua_in_time) values($u_id, '$ua_date', '$ua_time')";
        }
		$db->ex_query($sql);
        echo "ok";
    }
    exit();
}

if(isset($_POST['push_menu'])) {
	$opt = new option();
	$v = $opt->get_option('push_menu');
	if($v == "" || $v == 0) {
		$v = 1;
	} else {
		$v = 0;
	}
	$opt->save_option('push_menu', $v);
	exit();
}