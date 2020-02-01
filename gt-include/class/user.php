<?php
class user
{
    public function get_user_name($u_id)
    {
        $db = new database();
        $user = $db->get_var_query("select u_name from user where u_id = $u_id", 1);
        if($user) {
            return $user;
        } else {
            return " ";
        }
    }

    public function get_user_family($u_id)
    {
        $db = new database();
        $user = $db->get_var_query("select u_family from user where u_id = $u_id", 1);
        if($user) {
            return $user;
        } else {
            return " ";
        }
    }

    public function get_user_type($username)
    {
        $db = new database();
        $user_type = $db->get_select_query("select user_type from user where u_username = '$username'", 1);
        return $user_type;
    }

    public function get_account_id($username)
    {
        $db = new database();
        $account_id = $db->get_var_query("select a_id from user where u_username = '$username'", 1);
        return $account_id;
    }

    public function get_user_id($username)
    {
        $db = new database();
        $user_id = $db->get_var_query("select u_id from user where u_username='$username'", 1);
        return $user_id;
    }

    public function is_admin($level)
    {
        if ($level == "مدیر")
            return true;
        else
            return false;
    }

}