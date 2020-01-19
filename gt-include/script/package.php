<?php
if(isset($_POST['get_package_info'])) {
    $pk_id = $_POST['pk_id'];
    $res = get_select_query("select * from package where pk_id = $pk_id");
    $pk_time = $res[0]['pk_time'];
    $pk_expire = $res[0]['pk_expire'];
    $pk_price = $res[0]['pk_price'];
    echo $pk_time . "," . $pk_expire . "," . $pk_price;
    exit();
}