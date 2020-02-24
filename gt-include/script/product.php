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

if (isset($_POST['set_pro_to_cart'])) {
    $db = new database();
    $factor = new factor();

    $p_id = $_POST['p_id'];
    $pr_id = $_POST['pr_id'];
    $f_count = 1;
    $pr_price = $db->get_var_query("select pr_sale from product where pr_id = $pr_id");
    $pr_stock = $db->get_var_query("select pr_stock from product where pr_id = $pr_id");
    $f_date = jdate('Y/m/d H:i');

    if ($pr_stock > 0) {
        $pr_stock--;
        //$db->ex_query("update product set pr_stock = $pr_stock where pr_id = $pr_id");

        $db->ex_query("insert into factor(p_id, pr_id, f_count, pr_price, f_date) values($p_id, $pr_id, $f_count, $pr_price, '$f_date')");

        $factor->shop_factor($p_id);
    } else {
        echo "این کالا تمام شده است";
    }
    exit();
}

if(isset($_POST['remove_from_factor'])) {
    $db = new database();
    $factor = new factor();

    $fid = $_POST['fid'];
    $pid = $_POST['pid'];
    $pr_stock = $db->get_var_query("select pr_stock from product where pr_id = $pid");
    $pr_stock++;
    //$db->ex_query("update product set pr_stock = $pr_stock where pr_id = $pid");

    $db->ex_query("delete from factor where f_id = $fid");
    $factor->shop_factor($pid);
    exit();
}

if(isset($_POST['remove_from_factor_regular'])) {
    $fid = $_POST['fid'];
    $pid = $_POST['pid'];
    $pr_stock = get_var_query("select pr_stock from product where pr_id = $pid");
    $pr_stock++;
    //ex_query("update product set pr_stock = $pr_stock where pr_id = $pid");
    ex_query("delete from factor where f_id = $fid");
    load_light_factor_regular($pid);
    exit();
}