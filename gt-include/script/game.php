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

if(isset($_POST['load_game'])) {
    $p_id = $_POST['p_id'];
    $g_id = $_POST['g_id'];
    $g = new game();
    echo $g->load_game($g_id);
    exit();
}

if(isset($_POST['game_change_count'])) {
    $g = new game();

    $new_count = $_POST['new_count'];
    $g_id = $_POST['g_id'];
    $g->set_change($g_id, 'count', $new_count);
    exit();
}

if(isset($_POST['set_vip'])) {
    $g = new game();
    $new_count = $_POST['new_count'];
    if($new_count == 0) {
        $type = "count";
        $new_count = 1;
	} else {
        $type = "vip";
    }
    $g_id = $_POST['g_id'];
    $g->set_change($g_id, $type, $new_count);
	exit();
}

if(isset($_POST['set_login'])) {
    $db = new database();
    $p_code = ltrim($_POST['p_code'], '0');
	if($p_code != "") {
		$p_id = $db->get_var_query("select p_id from person where p_code = '$p_code'");
	} else {
		$p_id = $_POST['p_id'];
	}
	
	$check1 = $db->get_var_query("select count(*) from person where p_id = $p_id");
	if($check1) {
		$g_type = $_POST['g_type'];
		$g_count = $_POST['g_count'];
		$g_in = jdate('H:i');
		$g_date = jdate('Y/m/d');
		$u_id = $_SESSION['user_id'];
		if($_POST['g_adj'] != "") {
			$g_adj = implode(', ', $_POST['g_adj']);
		} else {
			$g_adj = "";
		}

		$check = $db->get_select_query("select * from game where p_id = $p_id and g_status = 0");
		
		if(count($check) > 0) {
			echo "<br><div class='alert alert-danger'>شما یک ورود دارید که هنوز خروج آن ثبت نشده است</div>";
		} else {
			$sql = "insert into game(p_id, g_type, g_count, g_in, g_date, g_adjective, u_id) values($p_id, '$g_type', $g_count, '$g_in', '$g_date', '$g_adj', $u_id)";
			$g_id = $db->ex_query($sql);
			$gm_key = "count";
			$gm_value = $g_count;
			$db->ex_query("insert into game_meta(g_id, gm_key, gm_value, gm_date, gm_time) values($g_id, '$gm_key', '$gm_value', '$g_date', '$g_in')");
			echo "ok";
		}
	} else {
		echo "<br><div class='alert alert-danger'>کد وارد شده معتبر نمی باشد</div>";
	}
    exit();
}

if(isset($_POST['set_login2'])) {
    $db = new database();
	$p_name = $_POST['p_name'];
	$p_family = $_POST['p_family'];
	$p_mobile = $_POST['p_mobile'];
	$p_birth = $_POST['p_birth'];
	$p_gender = $_POST['p_gender'];
	$u_id = $_POST['u_id'];
	$p_regdate = $_POST['p_regdate'];
	$sql1 = "insert into person(p_name, p_family, p_mobile, p_birth, p_gender, u_id, p_regdate) values('$p_name', '$p_family', '$p_mobile', '$p_birth', $p_gender, $u_id, '$p_regdate')";
	$p_id = $db->ex_query($sql1);
	$check1 = $db->get_var_query("select count(*) from person where p_id = $p_id");
	if($check1) {
		$g_count = $_POST['g_count'];
		$g_type = $_POST['g_type'];
		$g_in = jdate('H:i');
		$g_date = jdate('Y/m/d');
		$u_id = $_SESSION['user_id'];
		if($_POST['g_adj'] != "") {
			$g_adj = implode(', ', $_POST['g_adj']);
		} else {
			$g_adj = "";
		}

		$check = $db->get_select_query("select * from game where p_id = $p_id and g_status = 0");
		
		if(count($check) > 0) {
			echo "<br><div class='alert alert-danger'>شما یک ورود دارید که هنوز خروج آن ثبت نشده است</div>";
		} else {
			$sql = "insert into game(p_id, g_type, g_count, g_in, g_date, g_adjective, u_id) values($p_id, '$g_type', $g_count, '$g_in', '$g_date', '$g_adj', $u_id)";
			$g_id = $db->ex_query($sql);
			$gm_key = "count";
			$gm_value = $g_count;
			$db->ex_query("insert into game_meta(g_id, gm_key, gm_value, gm_date, gm_time) values($g_id, '$gm_key', '$gm_value', '$g_date', '$g_in')");
			echo "ok";
		}
	} else {
		echo "<br><div class='alert alert-danger'>کد وارد شده معتبر نمی باشد</div>";
	}
    exit();
}

if(isset($_POST['set_out'])) {
    $pr = new prime();
    $db = new database();
    $gd = new gdate();
    $sms = new sms();
	
    $g_id = $_POST['g_id'];
	$total = $_POST['total'];
	$total_vip = $_POST['total_vip'];
	$extra = $_POST['extra'];
	$total_price = $_POST['total_price'];
	$total_vip_price = $_POST['total_vip_price'];
	$extra_price = $_POST['extra_price'];
	$used_sharj = $_POST['used_sharj'];
	$login_price = $_POST['login_price'];
	$total_shop = $_POST['total_shop'];
	$offer = $_POST['offer'];
	
    $g_out = jdate('H:i');
    $p_id = $db->get_var_query("select p_id from game where g_id = $g_id");

    $sql = "update game set g_out = '$g_out', g_total = $total, g_total_vip = $total_vip, ";
	$sql .= "g_extra = $extra, g_total_price = $total_price, g_total_vip_price = $total_vip_price, ";
	$sql .= "g_extra_price = $extra_price, g_used_sharj = $used_sharj, ";
	$sql .= "g_login_price = $login_price, g_total_shop = $total_shop, g_offer_price = $offer, ";
	$sql .= "g_status = 1 ";
	$sql .= "where g_id = $g_id";
	$db->ex_query($sql);
    $db->ex_query("update factor set f_status = 1 where p_id = $p_id");

    $mobile = $db->get_var_query("select p_mobile from person where p_id = $p_id");
    $expire = $db->get_var_query("select p_expire from person where p_id = $p_id");
	
	if($used_sharj > 0) {
        $sharj = $db->get_var_query("select p_sharj from person where p_id = $p_id");
		$new_sharj = $sharj - $used_sharj;
        if($new_sharj < 0 ){
            $new_sharj = 0;
        }
        $sql_update_sharj = "update person set p_sharj = $new_sharj where p_id = $p_id";
        $db->ex_query($sql_update_sharj);

        //$home = $pr->get_option('opt_name');
        //$sms->send_sms($mobile, "ممنون از اینکه به " . $home . " سر زدید. \n مانده شارژ اشتراک شما " . $gd->convert_minute($new_sharj) . " و تا تاریخ " . $expire . " معتبر می باشد.");
    }
    exit();
}