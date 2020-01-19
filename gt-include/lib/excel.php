<?php
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

if(isset($_GET['create_report'])) {
		
	$db = new database();
	$gd = new gdate();
	
	$res = $db->get_select_query("select * from person");
	
	var_dump($res);
	/*
	$columnHeader = '';  
	$columnHeader = "ردیف" . "\t" . "نام و نام خانوادگی" . "\t" . "نام پدر" . "\t" . "تاریخ تولد" . "\t" . "\t" . "موبایل" . "\t" . "\t" . "تاریخ ثبت نام" . "\t" . "میزان شارژ" . "\t" . "تاریخ اعتبار";  
	
	$setData = '';
	$rowData = ''; 
	$rowd = '';    
	$i = 1;
	$totald = 0;
	foreach ($res as $row) {	
		if($row['p_sharj'] != 0){
			$p_sharj = $gd->convert_minute($row['p_sharj']);
		} else {
			$p_sharj = 0;
		}
		$value = $i . "\t" . $row['p_name'] . " " . $row['p_family'] . "\t" . $row['p_fname'] . "\t" . $row['p_birth'] . "\t" . $row['p_mobile'] . "\t" . $row['p_regdate'] . " \t" . $p_sharj . "\t" . $row['p_expire'] . "\n";
		$rowData .= $value;	
		$i++;
	}
	
	$rowData .= $value;
	
	$setData .= trim($rowData) . "\n";  
	$name = time();
	header("Content-type: application/octet-stream");  
	header("Content-Disposition: attachment; filename=$name.xls");  
	header('Content-Transfer-Encoding: binary');
	header("Pragma: no-cache");  
	header("Expires: 0");  
 
	echo chr(255).chr(254).iconv("UTF-8", "UTF-16LE//IGNORE", $columnHeader . "\n" . $setData . "\n");
	*/
}