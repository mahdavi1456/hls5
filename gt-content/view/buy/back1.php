<?php
if(isset($_POST['load_data'])) {
	$fb_quantity = $_POST['fb_quantity'];
	$fb_price = $_POST['fb_price'];
	if($fb_quantity != "" && $fb_price != ""){
	echo $fb_quantity * $fb_price;
	}
}

exit();