<?php

class package
{
    function get_package_name($p_pack)
    {
        $db = new database();
        return $db->get_var_query("select pk_name from package where pk_id = $p_pack");
    }
}