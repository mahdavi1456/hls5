<?php
date_default_timezone_set('Asia/Tehran');
include"../../include/jdf.php";
function get_dbname_from_super($ac_id) {
	$myfile = fopen("super-config.txt", "r") or die("Unable to open asset!");
	$list = fread($myfile,filesize("super-config.txt"));
	$ex_list = explode("~;~", $list);
	foreach($ex_list as $exl) {
		$child_list = explode("=>", $exl);
		$a_id = $child_list[0];
		if($ac_id == $a_id){
			$db_info = $child_list[1];
			$db_inf_list = explode('~,~', $db_info);
			$dbname = $db_inf_list[0];
		}
	}
	return $dbname;
	fclose($myfile);
}

function get_username_from_super($ac_id) {
	$myfile = fopen("super-config.txt", "r") or die("Unable to open asset!");
	$list = fread($myfile,filesize("super-config.txt"));
	$ex_list = explode("~;~", $list);
	foreach($ex_list as $exl) {
		$child_list = explode("=>", $exl);
		$a_id = $child_list[0];
		if($ac_id == $a_id){
			$db_info = $child_list[1];
			$db_inf_list = explode('~,~', $db_info);
			$username = $db_inf_list[1];
		}
	}
	return $username;
	fclose($myfile);
}

function get_password_from_super($ac_id) {
	$myfile = fopen("super-config.txt", "r") or die("Unable to open asset!");
	$list = fread($myfile,filesize("super-config.txt"));
	$ex_list = explode("~;~", $list);
	foreach($ex_list as $exl) {
		$child_list = explode("=>", $exl);
		$a_id = $child_list[0];
		if($ac_id == $a_id){
			$db_info = $child_list[1];
			$db_inf_list = explode('~,~', $db_info);
			$password = $db_inf_list[2];
		}
	}
	return $password;
	fclose($myfile);
}

function get_connection_string(){
	$dbname = get_dbname_from_super(0);
	$username = get_username_from_super(0);
	$password = get_password_from_super(0);
	$pdo_conn = new PDO("mysql:host=localhost;dbname=$dbname;charset=utf8", "$username", "$password",
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    return $pdo_conn;
}

function ex_query($sql){
	$pdo_conn = get_connection_string();
	$pdo_statement = $pdo_conn->prepare($sql);
	$pdo_statement->execute();
	$id = $pdo_conn->lastInsertId();
	return $id;
}

function get_select_query($sql){
	$pdo_conn = get_connection_string();
	$pdo_statement = $pdo_conn->prepare($sql);
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
	return $result;
}

function get_var_query($sql){
	$pdo_conn = get_connection_string();
	$pdo_statement = $pdo_conn->prepare($sql);
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
	if($result)
		return $result[0][0];
	else
		return;
}

function check_login($username, $password){					
	$sql = "select a_id from user where u_username = '$username' and u_password = '$password'";
	$result = get_var_query($sql);
	if(count($result) > 0) {
		return "yes";
	} else {
		return "no";
	}
}

function alert($type, $msg){
	?>
	<div class="alert alert-<?php echo $type; ?> alert-dismissible">
        <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $msg; ?>
    </div>
	<?php
}

function get_product_name($id){
	$pdo_conn = get_connection_string();
	$pdo_statement = $pdo_conn->prepare("select name from product where ID=$id");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
	if(count($result)>0){
		return $result[0][0];
	}
}

function get_product_price($id){
	$pdo_conn = get_connection_string();
	$pdo_statement = $pdo_conn->prepare("select price from product where ID=$id");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
	if(count($result)>0){
		return $result[0][0];
	}
}

function get_customer_name($id){
	$pdo_conn = get_connection_string();
	$pdo_statement = $pdo_conn->prepare("select name, family from customer where ID=$id");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
	if(count($result)>0){
		return $result[0][0] . " " .$result[0][1];
	}
}

function get_user_name($id){
	$pdo_conn = get_connection_string();
	$pdo_statement = $pdo_conn->prepare("select namee, family from user where ID=$id");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
	if(count($result)>0){
		return $result[0][0] . " " .$result[0][1];
	}
}

function get_user_level($id){
	$pdo_conn = get_connection_string();
	$pdo_statement = $pdo_conn->prepare("select level from user where a_id = $account_id and ID=$id");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
	if(count($result)>0){
		return $result[0][0];
	}
}

function per_number($number){
    return str_replace(
        range(0, 9),
        array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'),
        $number
    );
}

function eng_number($number){
    return str_replace(
        array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'),
        range(0, 9),
        $number
    );
}

function get_name($table, $field, $id_name, $id_val){
	$pdo_conn = get_connection_string();
	$pdo_statement = $pdo_conn->prepare("select $field from $table where $id_name = $id_val");
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();
	if(count($result)>0){
		return $result[0][0];
	}
}

function get_option($key){
	if(isset($_SESSION['account_id'])) {
	    $account_id = $_SESSION['account_id'];
	} else {
	    $account_id = 0;
	}
	$res = get_var_query("select meta_value from setting where a_id = $account_id and meta_key = '$key'");
	return $res;
}

function save_option($key, $value){
	if(isset($_SESSION['account_id'])) { $account_id = $_SESSION['account_id']; } else { $_SESSION = []; header("location: login.php"); }
	$check = get_select_query("select * from setting where a_id = $account_id and meta_key = '$key'");
	if(count($check)>0){
		ex_query("update setting set meta_value = '$value' where meta_key = '$key' and a_id = $account_id");
	}else{
		ex_query("insert into setting(a_id, meta_key, meta_value) values($account_id, '$key', '$value')");
	}
}