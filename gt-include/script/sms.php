<?php
if(isset($_POST['check_send_type'])) {
    $send_type = $_POST['send_type'];
    $rcpt_nm = array();
    if($send_type==0){
        echo "0";
    } else if($send_type==1) {
        echo "1";
    } else if($send_type==2) {
        echo "2";
    }
    exit();
}