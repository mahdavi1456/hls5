<?php
class sms
{

    public function send_sms_super_admin($mobile, $msg)
    {
        $url = "https://ippanel.com/services.jspd";
        $rcpt_nm = array($mobile);
        $param = array(
            'uname' => "mahdavi1456",
            'pass' => "m54692764o",
            'from' => "5000125475",
            'message' => $msg,
            'to' => json_encode($rcpt_nm),
            'op' => 'send'
        );
        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response2 = curl_exec($handler);

        $response2 = json_decode($response2);
        $res_code = $response2[0];
        $res_data = $response2[1];
    }

    public function send_sms($mobile, $msg)
    {
        $opt = new option();
        $url = "https://ippanel.com/services.jspd";
        $rcpt_nm = array($mobile);
        $param = array(
            'uname' => $opt->get_option('sms_user'),
            'pass' => $opt->get_option('sms_pass'),
            'from' => $opt->get_option('sms_line'),
            'message' => $msg,
            'to' => json_encode($rcpt_nm),
            'op' => 'send'
        );
        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response2 = curl_exec($handler);

        $response2 = json_decode($response2);
        $res_code = $response2[0];
        $res_data = $response2[1];
        return $res_data;
    }

    public function send_sms1($msg, $rcpts)
    {
        $opt = new option();

        $url = "https://ippanel.com/services.jspd";
        $rcpt_nm = array();

        $list = explode(",", $rcpts);
        foreach ($list as $l) {
            array_push($rcpt_nm, $l);
        }

        $param = array(
            'uname' => $opt->get_option('sms_user'),
            'pass' => $opt->get_option('sms_pass'),
            'from' => $opt->get_option('sms_line'),
            'message' => $msg,
            'to' => json_encode($rcpt_nm),
            'op' => 'send'
        );
        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response2 = curl_exec($handler);

        $response2 = json_decode($response2);
        $res_code = $response2[0];
        $res_data = $response2[1];
        return $res_data;
    }

    public function get_sms_credit()
    {
        $opt = new option();
        $prime = new prime();

        $url = "https://ippanel.com/services.jspd";
        $param = array(
            'uname' => $opt->get_option('sms_user'),
            'pass' => $opt->get_option('sms_pass'),
            'op' => 'credit'
        );
        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response2 = curl_exec($handler);

        $response2 = json_decode($response2);
        $res_code = $response2[0];
        $res_data = $response2[1];
        if ($res_data == "the username or password is incorrect") {
            echo "تنظیمات پیامک اشتباه وارد شده است";
        } else {
            echo "شارژ پیامک شما: " . $prime->per_number(number_format(round($res_data / 10))) . " تومان";
        }
    }

    public function today_happy_nums() {
        $pr = new prime();
        $db = new database();
        $i = 0;
        $today = jdate('Y-m-d');
        $a_id = $_SESSION['account_id'];
        $sql = "select p_birth from person where a_id = $a_id";
        $res = $db->get_select_query($sql);
        if(count($res) > 0) {
            foreach($res as $row) {
                if($row['p_birth'] != NULL) {
                    $sp = explode('-', $row['p_birth']);
                    if(count($sp) > 0) {
                        $birth = $sp[1] . "/" . $sp[2];
                        $now = jdate('m/d');
                        if($birth==$now){
                            $i++;
                        }
                    }
                }
            }
        }
        echo "<span class='bubble'>" . $pr->per_number($i) . "</span>";
    }
	
	public function set_log($sl_type, $sl_bulk, $sl_rcpts, $sl_text)
	{
		$db = new database();
		$opt = new option();
		$sl_user = $_SESSION['user_id'];
		$sl_date = jdate('Y/m/d H:i');
		$sl_line = $opt->get_option('sms_line');
		$sql = "insert into sms_log(sl_type, sl_user, sl_date, sl_line, sl_bulk, sl_rcpts, sl_text) values('$sl_type', $sl_user, '$sl_date', '$sl_line', $sl_bulk, '$sl_rcpts', '$sl_text')";
		$db->ex_query($sql);
	}
	
	public function get_lines() {
        $opt = new option();
        $url = "https://ippanel.com/services.jspd";
        $param = array
        (
            'uname' => $opt->get_option('sms_user'),
            'pass' => $opt->get_option('sms_pass'),
            'op' => 'lines'
        );
        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response2 = curl_exec($handler);
        $response2 = json_decode($response2);
        $res_code = $response2[0];
        $res_data = $response2[1];
        return $res_data;
    }

}