<?php
if(isset($_POST['data'])){

    $sql = $_POST['data'];
    require_once"include/database.php";
    require_once"include/jdf.php";
    require_once"include/functions.php";
    require_once"class/etemad_date.php";
    require_once"class/etemad_jdf.php";
    require_once"class/etemad_db.php";
    $date = new etemad_date();
    $user = new user();
    $jdf = new etemad_jdf();
    $db = new etemad_db();

    $res = $db->get_select_query($sql);
    $columnHeader = '';
    $columnHeader = "ÑÏíÝ" . "\t" . "äÇã æ äÇã ÎÇäæÇÏí" . "\t" . "ÇÒ ÊÇÑíÎ" . "\t" . "ÊÇ ÊÇÑíÎ". "\t" . "ÊÚÏÇÏ ÑæÒ". "\t" . "ÇÒ ÓÇÚÊ". "\t" . "ÊÇÓÇÚÊ". "\t" . "ÓÇÚÇÊ ãÑÎÕí". "\t" . "ÚáÊ ãÑÎÕí". "\t" . "æÖÚíÊ ÊÇííÏ" ;

    $setData = '';
    $rowData = '';
    $rowd = '';
    $i = 1;
    $totald=0;
    foreach ($res as $value) {

        $fd = $value['l_fromdate'];
        $list = explode("-", $fd);
        $from_date = $jdf->gregorian_to_jalali($list[0],$list[1],$list[2], '/' );

        $td = $value['l_todate'];
        $list = explode("-", $td);
        $to_date = $jdf->gregorian_to_jalali($list[0],$list[1],$list[2], '/' );

        $name = $user->get_user_name($value['u_id']);

        $from = $value['l_fromhour'] . ":" . $value['l_frommin'];
        $to = $value['l_tohour'] . ":" . $value['l_tomin'];
        $h = $date->calc_time($value['l_fromhour'], $value['l_frommin'], $value['l_tohour'], $value['l_tomin']);
        if($value['l_status'] == "ÊÇííÏ ÔÏå"){
            $totald += $value['l_number'];
        }

        $totalh = $date->calc_time($value['l_fromhour'], $value['l_frommin'], $value['l_tohour'], $value['l_tomin']);
        $t = explode(":",$totalh);
        $th = $t[0];
        $tm = $t[1];
        $sum += $th;
        $sum2 += $tm;
        $totalhour = $sum . ":" . $sum2;
        $th = $date->calc_time2 ($sum , $sum2);

        $value = $i . " \t " . $name . " \t " . $from_date . " \t " . $to_date . " \t " . $value['l_number'] . "\t " . $from . " \t " . $to . " \t " . $h . " \t " . $value['l_reason'] . " \t " . $value['l_status'] . " \n";
        $rowData .= $value;

        $i++;


    }
    if($value['l_status'] == "ÊÇííÏ ÔÏå"){
        $totalh = $date->calc_time($value['l_fromhour'], $value['l_frommin'], $value['l_tohour'], $value['l_tomin']);
        $t = explode(":",$totalh);
        $th = $t[0];
        $tm = $t[1];
        $sum += $th;
        $sum2 += $tm;
        $totalhour = $sum . ":" . $sum2;
        $th = $date->calc_time2 ($sum , $sum2);
    }
    $value = " \t  \t  \n";
    $rowData .= $value;

    $value =  "\t \t \t \t \t \t \t \t ÌãÚ ÑæÒ åÇí ãÑÎÕí: " .$totald ." \t  ÌãÚ ÓÇÚÇÊ ãÑÎÕí: " .$th . " \n";
    $rowData .= $value;

    $setData .= trim($rowData) . "\n";

    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=User_Detail_Reoprt.xls");
    header('Content-Transfer-Encoding: binary');
    header("Pragma: no-cache");
    header("Expires: 0");

    echo chr(255).chr(254).iconv("UTF-8", "UTF-16LE//IGNORE", $columnHeader . "\n" . $setData . "\n");

    exit();
}