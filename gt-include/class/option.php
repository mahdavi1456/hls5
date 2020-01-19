<?php

class option
{

    public function get_option($key)
    {
        $db = new database();
        $res = $db->get_var_query("select meta_value from setting where meta_key = '$key'");
        return $res;
    }

    public function save_option($key, $value)
    {
        $db = new database();
        $check = $db->get_select_query("select * from setting where meta_key = '$key'");
        if (count($check) > 0) {
            $db->ex_query("update setting set meta_value = '$value' where meta_key = '$key'");
        } else {
            $db->ex_query("insert into setting(meta_key, meta_value) values('$key', '$value')");
        }
    }

    public function load_sign()
    {
        $prime = new prime();
        ?>
        <table class="no-screen table text-center table-striped table-bordered koodak">
            <tr>
                <td><?php echo $prime->per_number($this->get_option('opt_address')); ?></td>
            </tr>
        </table>
        <table class="no-screen table text-center table-striped table-bordered koodak">
            <tr>
                <td><?php echo $prime->per_number($this->get_option('opt_sign')); ?></td>
            </tr>
        </table>
        <?php
    }

}