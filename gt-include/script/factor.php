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
$db = new database();
if(isset($_POST['load_shop_factor'])) {
    $factor = new factor();

    $p_id = $_POST['p_id'];
    $factor->shop_factor($p_id);
    exit();
}

if(isset($_POST['set_regular_shop_status'])) {
    $p_id = $_POST['p_id'];
    $db->ex_query("update factor set f_status = 1 where p_id = $p_id");
    load_light_factor_regular($p_id);
    exit();
}

if(isset($_POST['set_price_regular_shop'])) {
    $p_id = $_POST['p_id'];
    $price = $db->get_var_query("select sum(pr_price) from factor where p_id = $p_id and f_status = 0");
    if($price) 
		echo $price; 
	else 
		echo 0;
    exit();
}

if(isset($_POST['set_pro_to_cart_regular'])) {
	$u_id = $_SESSION['user_id'];
    $p_id = $_POST['p_id'];
    $pr_id = $_POST['pr_id'];
    $f_count = 1;
    $pr_price = $db->get_var_query("select pr_sale from product where pr_id = $pr_id");
    $pr_stock = $db->get_var_query("select pr_stock from product where pr_id = $pr_id");
    $f_date = jdate('Y/m/d H:i');

    if($pr_stock > 0) {
        $pr_stock--;
        //ex_query("update product set pr_stock = $pr_stock where pr_id = $pr_id");

        $db->ex_query("insert into factor(p_id, pr_id, f_count, pr_price, f_date, u_id) values($p_id, $pr_id, $f_count, $pr_price, '$f_date', $u_id)");

        load_light_factor_regular($p_id);
    } else {
        echo "این کالا تمام شده است";
    }
    exit();
}

if(isset($_POST['load_regular_shop'])) {
    $p_id = $_POST['p_id'];
    load_light_factor_regular($p_id);
    exit();
}

if(isset($_POST['load_count'])) {
	$db = new database();
    $f_count = $_POST['f_count'];
	$f_id = $_POST['f_id'];
	$pr_id = $_POST['pr_id'];
	$pr_price = $db->get_var_query("select pr_sale from product where pr_id = $pr_id");
	$pr_price_new = $f_count * $pr_price;
    $db->ex_query("update factor set f_count = $f_count, pr_price = $pr_price_new where f_id = $f_id");
	echo $f_count;
	exit();
}


if(isset($_POST['load_price'])) {
	$db = new database();
	$pr_id = $_POST['pr_id'];
	$f_count = $_POST['f_count'];
	$pr_sale = 0;
	$total = 0;
	if($pr_id != "" && $f_count != ""){
		$res3 = $db->get_select_query("select * from product where pr_id = $pr_id");
		if(count($res3) > 0) {
			foreach($res3 as $row3) {
				$pr_sale = $row3['pr_sale'];
			}
		}
		$total = $pr_sale * $f_count;
		echo $total;
	}
	else {
		echo "";
	}
	exit();
}