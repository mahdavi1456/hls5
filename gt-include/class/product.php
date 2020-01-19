<?php

class product
{

    public function get_product_name($pr_id)
    {
        $db = new database();

        $sql = "select pr_name from product where pr_id = $pr_id";
        $pr_name = $db->get_var_query($sql);
        return $pr_name;
    }

}