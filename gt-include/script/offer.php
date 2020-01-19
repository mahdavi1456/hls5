<?php
if (isset($_POST['calc_offer'])) {
    $o_id = $_POST['o_id'];
    $price = $_POST['price'];
    $o_type = get_var_query("select o_type from offer where o_id = $o_id");
    $o_per = get_var_query("select o_per from offer where o_id = $o_id");
    if ($o_type == "درصد") {
        echo (int)(($price * $o_per) / 100);
    } else {
        echo (int)$o_per;
    }
    exit();
}