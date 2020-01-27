<?php

class database
{
    public function get_connection_string()
    {
		if (isset($_SESSION['account_id'])) {
            $account_id = $_SESSION['account_id'];
            $dbname = $this->get_db_arg($account_id, 'a_db_name');
            $username = $this->get_db_arg($account_id, 'a_db_user');
            $password = $this->get_db_arg($account_id, 'a_db_password');
        } else {
            $dbname = 'helisoft_auth';
            $username = 'root';
            $password = '';
		}
		$pdo_conn = new PDO("mysql:host=localhost;dbname=$dbname;charset=utf8", "$username", "$password",
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

        return $pdo_conn;
    }
	
	public function sudo_get_connection_string()
    {
        $dbname = 'helisoft_auth';
        $username = 'root';
        $password = '';
		
		$pdo_conn = new PDO("mysql:host=localhost;dbname=$dbname;charset=utf8", "$username", "$password",
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

        return $pdo_conn;
    }

    public function ex_query($sql, $sudo = 0)
    {
		if($sudo == 1) {
			$pdo_conn = $this->sudo_get_connection_string();
        } else {
			$pdo_conn = $this->get_connection_string();
		}
        $pdo_statement = $pdo_conn->prepare($sql);
        $pdo_statement->execute();
        $id = $pdo_conn->lastInsertId();
        return $id;
    }

    public function get_select_query($sql, $sudo = 0)
    {
		if($sudo == 1) {
			$pdo_conn = $this->sudo_get_connection_string();
        } else {
			$pdo_conn = $this->get_connection_string();
		}
		$pdo_statement = $pdo_conn->prepare($sql);
        $pdo_statement->execute();
        $result = $pdo_statement->fetchAll();
        return $result;
    }

    public function get_var_query($sql, $sudo = 0)
    {
		if($sudo == 1) {
			$pdo_conn = $this->sudo_get_connection_string();
        } else {
			$pdo_conn = $this->get_connection_string();
		}
        $pdo_statement = $pdo_conn->prepare($sql);
        $pdo_statement->execute();
        $result = $pdo_statement->fetchAll();
        if ($result)
            return $result[0][0];
        else
            return;
    }

    public function check_login($username, $password)
    {
        $dbname = 'helisoft_auth';
        $db_username = 'root';
        $db_password = '';
        $pdo_conn = new PDO("mysql:host=localhost;dbname=" . $dbname . ";charset=utf8", $db_username, $db_password,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $sql = "select a_id from user where u_username = '$username' and u_password = '$password'";
        $pdo_statement = $pdo_conn->prepare($sql);
        $pdo_statement->execute();
        $result = $pdo_statement->fetchAll();
        if (count($result) > 0) {
            $a_id = $result[0][0];
		} else {
            $a_id = "no";
        }
		
		if($a_id == "no"){
			$aa_id = 0;
		} else {
			$aa_id = $a_id;
		}
		$lr_time = jdate('Y/m/d H:s:i');
		$pr = new prime();
		$lr_ip = $pr->get_ip();
		$sql_ins = "insert into login_record (a_id, lr_user, lr_pass, lr_time, lr_ip) values($aa_id, '$username', '$password', '$lr_time', '$lr_ip')";
		$pdo_statement = $pdo_conn->prepare($sql_ins);
        $pdo_statement->execute();
		return $a_id;
	}

    public function get_db_arg($account_id, $arg)
    {
        $dbname = 'helisoft_auth';
        $username = 'root';
        $password = '';
        $pdo_conn = new PDO("mysql:host=localhost;dbname=" . $dbname . ";charset=utf8", $username, $password,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $sql = "select $arg from account where a_id = $account_id";
        $pdo_statement = $pdo_conn->prepare($sql);
        $pdo_statement->execute();
        $result = $pdo_statement->fetchAll();
        if (count($result) > 0) {
            return $result[0][0];
        } else {
            return "no";
        }
    }
	
	public function get_accounts()
    {
        $dbname = 'helisoft_auth';
        $db_username = 'root';
        $db_password = '';
        $pdo_conn = new PDO("mysql:host=localhost;dbname=" . $dbname . ";charset=utf8", $db_username, $db_password,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $sql = "select * from account";
        $pdo_statement = $pdo_conn->prepare($sql);
        $pdo_statement->execute();
        $result = $pdo_statement->fetchAll();
        return $result;
    }

    public function alert($type, $msg)
    {
        ?>
        <div class="alert alert-<?php echo $type; ?> alert-dismissible">
            <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $msg; ?>
        </div>
        <?php
    }

    public function get_product_name($id)
    {
        $pdo_conn = $this->get_connection_string();
        $pdo_statement = $pdo_conn->prepare("select name from product where ID=$id");
        $pdo_statement->execute();
        $result = $pdo_statement->fetchAll();
        if (count($result) > 0) {
            return $result[0][0];
        }
    }

    public function get_product_price($id)
    {
        $pdo_conn = $this->get_connection_string();
        $pdo_statement = $pdo_conn->prepare("select price from product where ID=$id");
        $pdo_statement->execute();
        $result = $pdo_statement->fetchAll();
        if (count($result) > 0) {
            return $result[0][0];
        }
    }

    public function get_customer_name($id)
    {
        $pdo_conn = $this->get_connection_string();
        $pdo_statement = $pdo_conn->prepare("select name, family from customer where ID=$id");
        $pdo_statement->execute();
        $result = $pdo_statement->fetchAll();
        if (count($result) > 0) {
            return $result[0][0] . " " . $result[0][1];
        }
    }

    public function get_user_name($id)
    {
        $pdo_conn = $this->sudo_get_connection_string();
        $pdo_statement = $pdo_conn->prepare("select namee, family from user where ID=$id");
        $pdo_statement->execute();
        $result = $pdo_statement->fetchAll();
        if (count($result) > 0) {
            return $result[0][0] . " " . $result[0][1];
        }
    }

    public function get_user_level($id)
    {
        $pdo_conn = $this->sudo_get_connection_string();
        $pdo_statement = $pdo_conn->prepare("select level from user where a_id = $account_id and ID=$id");
        $pdo_statement->execute();
        $result = $pdo_statement->fetchAll();
        if (count($result) > 0) {
            return $result[0][0];
        }
    }

    public function get_name($table, $field, $id_name, $id_val)
    {
        $pdo_conn = $this->get_connection_string();
        $pdo_statement = $pdo_conn->prepare("select $field from $table where $id_name = $id_val");
        $pdo_statement->execute();
        $result = $pdo_statement->fetchAll();
        if (count($result) > 0) {
            return $result[0][0];
        }
    }
	
	public function create_database()
	{/*
		$host = "heliapp.ir";
		$root = "helisoft_gratech_user";
		$root_password = "bt*zIc^CPkLP";

		$user = 'newuser';
		$pass = 'newpass';
		$db = "newdb";
		try {
			$dbh = new PDO("mysql:host=$host", $root, $root_password);

			$dbh->exec("CREATE DATABASE `$db`;
                CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
                GRANT ALL ON `$db`.* TO '$user'@'localhost';
                FLUSH PRIVILEGES;") 
			or die(print_r($dbh->errorInfo(), true));

		} catch (PDOException $e) {
			die("DB ERROR: ". $e->getMessage());
		}*/
	}

}